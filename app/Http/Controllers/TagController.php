<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::orderBy('name')->paginate(50);

        if ($request->expectsJson()) {
            return response()->json($tags);
        }

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150|unique:tags,slug',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $tag = Tag::create($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $tag], 201);
        }

        return redirect()->route('tags.index')->with('success', 'Tag created.');
    }

    public function show(Tag $tag, Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json($tag);
        }

        return view('tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => [
                'nullable',
                'string',
                'max:150',
                Rule::unique('tags', 'slug')->ignore($tag->id),
            ],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $tag->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $tag]);
        }

        return redirect()->route('tags.index')->with('success', 'Tag updated.');
    }

    public function destroy(Request $request, Tag $tag)
    {
        $tag->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('tags.index')->with('success', 'Tag deleted.');
    }
}
