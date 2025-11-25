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
use Illuminate\Support\Facades\Storage;

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

            
             'tags'              => 'nullable|string',
            // 'tags.*'            => 'integer|exists:tags,id',

            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $authorId = $request->user()?->id ?? 1;

        // generate slug if empty
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

       
        $uploadedImage = $request->file('image');

        
        $tagNames = collect();



        if (!empty($data['tags'])) {
            $tagNames = collect(explode(',', $data['tags']))
                ->map(fn ($tag) => trim($tag))
                ->filter()          
                ->unique();         
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

                
                 'content'          => $data['content'] ?? null,

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
                        ['name' => $data['tags']],
                        ['slug' => $data['tags']]
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


    public function show(string $slug, Request $request)
    {
        
        $post = Post::with(['author', 'category', 'tags', 'featuredImage', 'comments'])
                    ->where('slug', $slug)
                    ->firstOrFail();

        if ($request->expectsJson()) {
            return response()->json($post);
        }

        return view('frontend.singlenews', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        
        $tagString = $post->tags->pluck('name')->implode(',');

        return view('backend.edit-post', compact('post', 'categories', 'tagString'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'category_id'       => 'nullable|exists:categories,id',
            'featured_image_id' => 'nullable|exists:media,id',
            'title'             => 'required|string|max:255',
            'slug'              => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post->id),
            ],
            'subheading'        => 'nullable|string|max:255',
            'excerpt'           => 'nullable|string',

            // content ফিল্ড 그대로 রাখছি
            'content'           => 'nullable|string',

            'status'            => ['required', Rule::in(['draft', 'pending', 'published', 'archived'])],
            'is_breaking'       => 'sometimes|boolean',
            'is_featured'       => 'sometimes|boolean',
            'published_at'      => 'nullable|date',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',

            // ট্যাগগুলো কমা সেপারেটেড string
            'tags'              => 'nullable|string',

            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $authorId = $post->author_id ?? ($request->user()?->id ?? 1);

        // slug খালি থাকলে title থেকে বানানো
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $uploadedImage = $request->file('image');

        // tags string কে ভেঙে নেওয়া (seo,marketing,tv guide)
        $tagNames = collect();

        if (!empty($data['tags'])) {
            $tagNames = collect(explode(',', $data['tags']))
                ->map(fn ($tag) => trim($tag))
                ->filter()
                ->unique();
        }

        $post = DB::transaction(function () use ($data, $authorId, $uploadedImage, $tagNames, $post) {
            
            $featuredMediaId = $data['featured_image_id'] ?? $post->featured_image_id;

            
            if ($uploadedImage) {
                
                if ($post->featuredImage) {
                    Storage::disk('public')->delete($post->featuredImage->file_path);
                    $post->featuredImage->delete();
                }

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

            // 2) Post update
            $post->update([
                'author_id'        => $authorId,
                'category_id'      => $data['category_id'] ?? null,
                'featured_image_id'=> $featuredMediaId,
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

           
            if ($tagNames->isNotEmpty()) {
                $tagIds = [];

                foreach ($tagNames as $tagName) {
                    $tag = Tag::firstOrCreate(
                        ['slug' => Str::slug($tagName)],
                        ['name' => $tagName]
                    );

                    $tagIds[] = $tag->id;
                }

               
                $post->tags()->sync($tagIds);
            } else {
               
                $post->tags()->sync([]);
            }

            return $post;
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data'    => $post->load('tags', 'featuredImage'),
            ], 200);
        }

        return redirect()
            ->back()
            ->with('success', 'Post updated.');
    }

    public function destroy(Request $request, Post $post)
    {
           
        if ($post->featuredImage) {
            \Storage::disk('public')->delete($post->featuredImage->file_path);
            $post->featuredImage()->delete();
        }
        $post->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Post deleted.');
    }


    //news by category
    public function categoryNews(Request $request, string $slug)
    {
        // dd('Route hit with slug: ' . $slug);
        $category = Category::where('slug', $slug)->firstOrFail();
        // dd($category->id);
        $posts = Post::where('category_id', $category->id)->orderBy('created_at', 'desc')->with(['author', 'featuredImage', 'tags', 'comments'])->paginate(4);
        // dd($posts);
        return view('frontend.categorywisenews', [
            'category' => $category,
            'slug'     => $slug,
            'posts' => $posts
        ]);
    }
}
