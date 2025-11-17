<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Media;
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
            'featured_image_id' => 'nullable|exists:media,id', // optional existing media
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:posts,slug',
            'subheading'        => 'nullable|string|max:255',
            'excerpt'           => 'nullable|string',

            // 👉 এখানে content শুধু tag string হিসেবে আসবে (e.g. "seo,marketing,tv guide")
            'content'           => 'nullable|string',

            'status'            => ['required', Rule::in(['draft', 'pending', 'published', 'archived'])],
            'is_breaking'       => 'sometimes|boolean',
            'is_featured'       => 'sometimes|boolean',
            'published_at'      => 'nullable|date',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',

            // চাইলে এগুলো এখন বাদও দিতে পারো, যদি আর ব্যবহার না করো
            // 'tags'              => 'nullable|array',
            // 'tags.*'            => 'integer|exists:tags,id',

            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $authorId = $request->user()?->id ?? 1;

        // generate slug if empty
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // uploaded image (if any)
        $uploadedImage = $request->file('image');

        // 🔹 content স্ট্রিং থেকে tag নামগুলো বের করি (post টেবিলে content কলাম নেই, so just input)
        $tagNames = collect();



        if (!empty($data['content'])) {
            $tagNames = collect(explode(',', $data['content']))
                ->map(fn ($tag) => trim($tag))
                ->filter()          // ফাঁকা বাদ
                ->unique();         // ডুপ্লিকেট বাদ
        }

        $post = DB::transaction(function () use ($data, $authorId, $uploadedImage, $tagNames) {
            $featuredMediaId = $data['featured_image_id'] ?? null;

            // 1) handle image
            if ($uploadedImage) {
                $path = $uploadedImage->store('posts', 'public');

                $media = Media::create([
                    'file_name'   => $uploadedImage->getClientOriginalName(),
                    'file_path'   => $path,
                    'mime_type'   => $uploadedImage->getClientMimeType(),
                    'file_size'   => $uploadedImage->getSize(),
                    'alt_text'    => $data['meta_title'] ?? $data['title'] ?? null,
                    'uploaded_by' => $authorId,
                ]);

                $featuredMediaId = $media->id;
            }

            // 2) Create the post
            $post = Post::create([
                'author_id'        => $authorId,
                'category_id'      => $data['category_id'] ?? null,
                'featured_image_id'=> $featuredMediaId,
                'title'            => $data['title'],
                'slug'             => $data['slug'],
                'subheading'       => $data['subheading'] ?? null,
                'excerpt'          => $data['excerpt'] ?? null,

                // ❌ এখানে আর content পাঠাচ্ছি না, কারণ Post model/table এ কলাম নেই
                // 'content'          => $data['content'] ?? null,

                'status'           => $data['status'],
                'is_breaking'      => $data['is_breaking'] ?? false,
                'is_featured'      => $data['is_featured'] ?? false,
                'published_at'     => $data['published_at'] ?? null,
                'meta_title'       => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
            ]);

            // 3) Create/attach tags from tagNames
            if ($tagNames->isNotEmpty()) {
                $tagIds = [];

                    $tag = Tag::create(
                        ['name' => $data['content']],
                        ['slug' => $data['content']]
                    );
                foreach ($tagNames as $tagName) {


                    $tagIds[] = $tag->id;
                }

                // post_tag pivot এ attach / sync
                $post->tags()->sync($tagIds);
            }

            return $post;
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data'    => $post->load('tags', 'featuredImage'),
            ], 201);
        }

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post created.');
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


    //news by category
    public function categoryNews(Request $request, $slug)
    {
        $catId = Category::where('slug', $slug)->pluck('id')->get();
        $newsItems = Post::where('category_id', $catId)->paginate(10);
        return view('singlenews')->compact('newsItems');
    }
}
