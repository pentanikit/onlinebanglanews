<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::orderBy('id', 'desc')->paginate(30);

        if ($request->expectsJson()) {
            return response()->json($media);
        }

        return view('media.index', compact('media'));
    }

    public function create()
    {
        return view('media.create');
    }

public function store(Request $request)
{
    $fieldName = null;

    if ($request->hasFile('logo')) {
        $fieldName = 'logo';
    } elseif ($request->hasFile('favicon')) {
        $fieldName = 'favicon';
    } elseif ($request->hasFile('file')) {
        $fieldName = 'file';
    }

    if (!$fieldName) {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'কোনো ফাইল পাওয়া যায়নি।',
            ], 422);
        }

        return back()->withErrors(['file' => 'কোনো ফাইল পাওয়া যায়নি।']);
    }

    $validated = $request->validate([
        $fieldName  => 'required|file|mimes:jpg,jpeg,png,webp,gif,svg,ico|max:5120',
        'alt_text'  => 'nullable|string|max:255',
        'type'      => 'nullable|string|max:255', // logo, favicon, etc.
    ]);

    $type = $request->input('type'); // 'logo' / 'favicon' / others

    // If uploading logo or favicon, remove old one first
    if (in_array($type, ['logo', 'favicon'])) {
        $existing = Media::where('alt_text', $type)->first();

        if ($existing) {
            if (!empty($existing->file_path) && Storage::disk('public')->exists($existing->file_path)) {
                Storage::disk('public')->delete($existing->file_path);
            }

            $existing->delete();
        }

        // 🔄 Clear cache so next call to logo()/favicon() gets fresh data
        Cache::forget("media_setting_{$type}");
    }

    // Upload new file
    $file = $request->file($fieldName);

    $path = $file->store('uploads/media', 'public');

    $media = Media::create([
        'file_name'   => $file->getClientOriginalName(),
        'file_path'   => $path,
        'mime_type'   => $file->getMimeType(),
        'file_size'   => $file->getSize(),
        'alt_text'    => $type ?? $request->input('alt_text'),
        'uploaded_by' => $request->user()?->id ?? 1,
    ]);

    // Clear cache again just in case (after create)
    if (in_array($type, ['logo', 'favicon'])) {
        Cache::forget("media_setting_{$type}");
    }

    $message = 'মিডিয়া সফলভাবে আপলোড হয়েছে।';
    if ($type === 'logo') {
        $message = 'লোগো সফলভাবে আপলোড হয়েছে।';
    } elseif ($type === 'favicon') {
        $message = 'ফেভিকন সফলভাবে আপলোড হয়েছে।';
    }

    $responseData = [
        'success' => true,
        'message' => $message,
        'data'    => $media,
    ];

    if ($request->expectsJson() || $request->ajax()) {
        return response()->json($responseData, 201);
    }

    return redirect()
        ->back()
        ->with('success', $message);
}


    public function show(Media $media, Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json($media);
        }

        return view('media.show', compact('media'));
    }

    public function edit(Media $media)
    {
        return view('media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $data = $request->validate([
            'alt_text' => 'nullable|string|max:255',
        ]);

        $media->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $media]);
        }

        return redirect()->route('media.index')->with('success', 'Media updated.');
    }

    public function destroy(Request $request, Media $media)
    {
        // delete file
        if ($media->file_path && str_starts_with($media->file_path, 'storage/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $media->file_path));
        }

        $media->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('media.index')->with('success', 'Media deleted.');
    }
}
