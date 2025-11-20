@extends('frontend.layout')
@section('pages')
    <!-- Page Title -->
    <div class="container">
        <div class="page-title-wrap">
            <h2>{{ $category->name }}</h2>
            <p>সাম্প্রতিক সব {{ $category->name }} খবর একসাথে</p>
        </div>
    </div>

    @if ($posts->isNotEmpty())
        @php
            $lead = $posts->first(); // প্রথম নিউজ

            $others = $posts->skip(1); // বাকি সব নিউজ
        @endphp


        <!-- Main Layout -->
        <div class="container main-layout">
            <main class="content">
                <!-- Featured of this category -->
                <article class="lead-news">
                    <img src="{{ asset('storage') . '/' . $lead->featuredImage->file_path }}" alt="">
                    <h2>{{ $lead->title }}</h2>
                    <p class="meta">{{ $lead->author->name }} | ১১ নভেম্বর ২০২৫</p>
                    <p class="excerpt">
                        {{ $lead->excerpt }}
                    </p>
                </article>

                <!-- Category listing -->
                <div class="category-list">

                    @foreach ($others as $item)
                        <article class="cat-item">
                            <h3><a href="{{ route('singleNews', $item->slug) }}">{{ $item->title }}</a></h3>
                            <p class="meta">{{ $item->author->name }} | ১১ নভেম্বর ২০২৫</p>
                            <p>{{ $item->excerpt }}</p>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination (dummy) -->
                {{-- <div class="pagination">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">পরের পাতা »</a>
                </div> --}}
            </main>

            <!-- Sidebar -->
            <aside class="sidebar">
                <x-frontend.latest-news />
                <div class="widget ad-widget">
                    <span>300x250 AD</span>
                </div>
            </aside>
        </div>
    @else
    @endif


@endsection
