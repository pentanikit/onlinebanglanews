{{-- resources/views/posts/edit.blade.php --}}
@extends('backend.main') {{-- অথবা আপনার যেটা main admin layout --}}
@section('title', 'পোস্ট এডিট')

@section('content')
<div class="container-fluid py-3">

    {{-- Page header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">পোস্ট এডিট করুন</h4>
        {{-- <div>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> সব পোস্ট
            </a>
        </div> --}}
    </div>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>দয়া করে নিচের ভুলগুলো ঠিক করুন:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <strong>{{ $post->title }}</strong> পোস্ট আপডেট ফর্ম
        </div>

        <div class="card-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- ক্যাটাগরি --}}
                    <div class="col-md-4">
                        <label class="form-label">ক্যাটাগরি</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- ক্যাটাগরি সিলেক্ট করুন --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- টাইটেল --}}
                    <div class="col-md-8">
                        <label class="form-label">শিরোনাম</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $post->title) }}" required>
                    </div>

                    {{-- স্লাগ --}}
                    <div class="col-md-6">
                        <label class="form-label">স্লাগ (ঐচ্ছিক)</label>
                        <input type="text" name="slug" class="form-control"
                            value="{{ old('slug', $post->slug) }}">
                    </div>



                    {{-- এক্সসার্প্ট --}}
                    <div class="col-12">
                        <label class="form-label">সংক্ষিপ্ত বিবরণ</label>
                        <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>

                    {{-- মূল কনটেন্ট --}}
                    <div class="col-12">
                        <label class="form-label">কনটেন্ট</label>
                        <textarea name="content" class="form-control" rows="6">{{ old('content', $post->content) }}</textarea>
                    </div>

                    {{-- ট্যাগ UI (তোমার আগের স্টাইল ধরে) --}}
                    <div class="col-12">
                        <label class="form-label">ট্যাগ</label>

                        <!-- ট্যাগ বক্স -->
                        <div id="tagBox" class="form-control d-flex flex-wrap align-items-center gap-2"
                            style="min-height: 46px;">
                            <!-- এখানে জাভাস্ক্রিপ্ট দিয়ে ট্যাগগুলো আসবে -->
                            <input type="text" id="tagInput" class="border-0 flex-grow-1"
                                style="outline: none; min-width: 120px;"
                                placeholder="ট্যাগ লিখে Enter বা Space চাপুন">
                        </div>

                        <!-- এখানে কমা-সেপারেটেড ট্যাগ গুলো যাবে (form submit হবে এই ফিল্ড দিয়ে) -->
                        <textarea class="form-control d-none" name="tags" id="tagStorage" rows="2">
                            {{ old('tags', $tagString ?? '') }}
                        </textarea>
                    </div>

                    {{-- স্ট্যাটাস --}}
                    <div class="col-md-4">
                        <label class="form-label">স্ট্যাটাস</label>
                        <select name="status" class="form-select" required>
                            @foreach(['draft' => 'Draft', 'pending' => 'Pending', 'published' => 'Published', 'archived' => 'Archived'] as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('status', $post->status) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ব্রেকিং / ফিচার্ড --}}
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="isBreaking" name="is_breaking"
                                value="1" {{ old('is_breaking', $post->is_breaking) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isBreaking">ব্রেকিং নিউজ</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="isFeatured" name="is_featured"
                                value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isFeatured">ফিচার্ড</label>
                        </div>
                    </div>





                    {{-- ফিচার্ড ইমেজ --}}
                    <div class="col-md-6">
                        <label class="form-label">Featured Image</label>
                        <input type="file" name="image" class="form-control">

                        @if($post->featuredImage)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$post->featuredImage->file_path) }}"
                                    alt="{{ $post->featuredImage->alt_text }}"
                                    style="max-width: 150px; height:auto;">
                            </div>
                        @endif
                    </div>

                    {{-- সাবমিট --}}
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-primary">আপডেট করুন</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

      {{-- tag input style --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tagBox = document.getElementById('tagBox');
                const tagInput = document.getElementById('tagInput');
                const tagStorage = document.getElementById('tagStorage');

                const tags = [];

                function renderTags() {
                    // আগের সব ট্যাগ pill রিমুভ করি (input বাদে)
                    tagBox.querySelectorAll('.tag-pill').forEach(el => el.remove());

                    tags.forEach((tag, index) => {
                        const pill = document.createElement('span');
                        pill.className =
                            'tag-pill badge bg-secondary me-1 mb-1 d-inline-flex align-items-center';

                        pill.innerHTML = `
                  <span class="me-1">${tag}</span>
                  <button type="button" class="btn-close btn-close-white btn-sm ms-1" aria-label="Remove"></button>
              `;

                        // রিমুভ বাটন ক্লিক
                        pill.querySelector('button').addEventListener('click', function() {
                            removeTag(index);
                        });

                        // input এর আগে ইনসার্ট করি
                        tagBox.insertBefore(pill, tagInput);
                    });

                    // hidden textarea তে কমা দিয়ে সব ট্যাগ সেভ
                    tagStorage.value = tags.join(',');
                }

                function addTag(text) {
                    const value = text.trim();
                    if (!value) return;

                    // ডুপ্লিকেট ট্যাগ না নেওয়া চাইলে
                    if (tags.includes(value)) {
                        tagInput.value = '';
                        return;
                    }

                    tags.push(value);
                    tagInput.value = '';
                    renderTags();
                }

                function removeTag(index) {
                    tags.splice(index, 1);
                    renderTags();
                }

                // Enter বা Space চাপলে ট্যাগ বানাবে
                tagInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        addTag(tagInput.value);
                    } else if (e.key === 'Backspace' && !tagInput.value && tags.length) {
                        // ইনপুট খালি থাকলে Backspace চাপে শেষ ট্যাগ ডিলিট করবে
                        tags.pop();
                        renderTags();
                    }
                });
            });
        </script>

@endsection
