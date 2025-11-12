<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validate([
            'file'      => 'required|file|mimes:jpg,jpeg,png,webp,gif,svg|max:5120',
            'alt_text'  => 'nullable|string|max:255',
        ]);

        $path = $request->file('file')->store('uploads/media', 'public');

        $media = Media::create([
            'file_name'   => $request->file('file')->getClientOriginalName(),
            'file_path'   => 'storage/' . $path,
            'mime_type'   => $request->file('file')->getMimeType(),
            'file_size'   => $request->file('file')->getSize(),
            'alt_text'    => $data['alt_text'] ?? null,
            'uploaded_by' => $request->user()?->id,
        ]);

        // Example: dispatch(new OptimizeImageJob($media->id));

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $media], 201);
        }

        return redirect()->route('media.index')->with('success', 'Media uploaded.');
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
