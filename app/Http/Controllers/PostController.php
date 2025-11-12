<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['author', 'category', 'featuredImage'])
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20);

        if ($request->expectsJson()) {
            return response()->json($posts);
        }

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'       => 'nullable|exists:categories,id',
            'featured_image_id' => 'nullable|exists:media,id',
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:posts,slug',
            'subheading'        => 'nullable|string|max:255',
            'excerpt'           => 'nullable|string',
            'content'           => 'nullable|string',
            'status'            => ['required', Rule::in(['draft', 'pending', 'published', 'archived'])],
            'is_breaking'       => 'sometimes|boolean',
            'is_featured'       => 'sometimes|boolean',
            'published_at'      => 'nullable|date',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'tags'              => 'nullable|array',
            'tags.*'            => 'integer|exists:tags,id',
        ]);

        $authorId = $request->user()?->id ?? 1;

        // generate slug if empty
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // transaction for post + tag pivot
        $post = DB::transaction(function () use ($data, $authorId) {
            $post = Post::create([
                'author_id'        => $authorId,
                'category_id'      => $data['category_id'] ?? null,
                'featured_image_id'=> $data['featured_image_id'] ?? null,
                'title'            => $data['title'],
                'slug'             => $data['slug'],
                'subheading'       => $data['subheading'] ?? null,
                'excerpt'          => $data['excerpt'] ?? null,
                'content'          => $data['content'] ?? null,
                'status'           => $data['status'],
                'is_breaking'      => $data['is_breaking'] ?? false,
                'is_featured'      => $data['is_featured'] ?? false,
                'published_at'     => $data['published_at'] ?? null,
                'meta_title'       => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
            ]);

            if (!empty($data['tags'])) {
                $post->tags()->sync($data['tags']);
            }

            return $post;
        });

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $post->load('tags')], 201);
        }

        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    public function show(Post $post, Request $request)
    {
        $post->load(['author', 'category', 'tags', 'featuredImage', 'comments']);

        if ($request->expectsJson()) {
            return response()->json($post);
        }

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $post->load('tags');
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'category_id'       => 'nullable|exists:categories,id',
            'featured_image_id' => 'nullable|exists:media,id',
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'subheading'        => 'nullable|string|max:255',
            'excerpt'           => 'nullable|string',
            'content'           => 'nullable|string',
            'status'            => ['required', Rule::in(['draft', 'pending', 'published', 'archived'])],
            'is_breaking'       => 'sometimes|boolean',
            'is_featured'       => 'sometimes|boolean',
            'published_at'      => 'nullable|date',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'tags'              => 'nullable|array',
            'tags.*'            => 'integer|exists:tags,id',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        DB::transaction(function () use ($post, $data) {
            $post->update([
                'category_id'      => $data['category_id'] ?? null,
                'featured_image_id'=> $data['featured_image_id'] ?? null,
                'title'            => $data['title'],
                'slug'             => $data['slug'],
                'subheading'       => $data['subheading'] ?? null,
                'excerpt'          => $data['excerpt'] ?? null,
                'content'          => $data['content'] ?? null,
                'status'           => $data['status'],
                'is_breaking'      => $data['is_breaking'] ?? false,
                'is_featured'      => $data['is_featured'] ?? false,
                'published_at'     => $data['published_at'] ?? null,
                'meta_title'       => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
            ]);

            $post->tags()->sync($data['tags'] ?? []);
        });

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $post->load('tags')]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Request $request, Post $post)
    {
        $post->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }
}
