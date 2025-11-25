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

                    <a href="{{ route('singleNews', $lead->slug) }}">
                        <h2>{{ $lead->title }}</h2>
                        <p class="meta">{{ $lead->author->name }} | {{ \App\Helpers\BanglaDate::format($lead->created_at) }}</p>
                        <img style="max-width: 100%; max-height: 400px; object-fit:contain;" src="{{ asset('storage') . '/' . $lead->featuredImage->file_path ?? 'https://placehold.co/600x400' }}"
                            alt="">
                        <p class="excerpt">
                            {{ $lead->excerpt }}
                        </p>
                    </a>

                </article>

                <!-- Category listing -->
                <div class="category-list">

                    @foreach ($others as $item)
                        <article class="cat-item">
                            <a href="{{ route('singleNews', $lead->slug) }}">
                                <h3 class="p-2"><a href="{{ route('singleNews', $item->slug) }}">{{ $item->title }}</a></h3>

                                <p class="meta py-2" style="font-size: 12px;">{{ $item->author->name }} | {{ \App\Helpers\BanglaDate::format($item->created_at) }}
</p>
                                <img style="max-width:440px; max-height: 240px; object-fit:contain;"
                                    src="{{ asset('storage') . '/' . $item->featuredImage->file_path ?? 'https://placehold.co/600x400' }}"
                                    alt="">
                                <p>{{ \Illuminate\Support\Str::limit($item->excerpt, 250) }}</p>
                            </a>

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

      <div class="widget" >
        <h3>জনপ্রিয়</h3>
        <ul class="list">
          <li><a href="#">দামের মধ্যে যেসব স্মার্টফোন বাজারে</a></li>
          <li><a href="#">শীতে ত্বকের যত্ন নেবেন যেভাবে</a></li>
          <li><a href="#">বাংলাদেশ দলের বিশ্বকাপ বিশ্লেষণ</a></li>
        </ul>
      </div>

      @php $ad = ad1('home_sidebar'); @endphp
      @if($ad && $ad->image)
        <div class="widget ad-widget">
          <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 1">
        </div>
      @endif

      <x-frontend.sport-news />

      @php $ad = ad2('home_sidebar'); @endphp
      @if($ad && $ad->image)
        <div class="widget ad-widget">
          <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 2">
        </div>
      @endif

      <x-frontend.celeb-news />

      @php $ad = ad3('home_sidebar'); @endphp
      @if($ad && $ad->image)
        <div class="widget ad-widget">
          <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 3">
        </div>
      @endif

      <x-frontend.job-news />

      @php $ad = ad4('home_sidebar'); @endphp
      @if($ad && $ad->image)
        <div class="widget ad-widget">
          <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 4">
        </div>
      @endif

    </aside>
        </div>
    @else
    @endif


@endsection
