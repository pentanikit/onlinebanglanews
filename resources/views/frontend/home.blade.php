@extends('frontend.layout')
@section('pages')
      <!-- Main Layout -->
  <div class="container main-layout">
    <!-- Left/Main Column -->
    <main class="content">
      <!-- Lead News -->
      <x-frontend.breaking-news />

      {{-- bangladesh news --}}
      <x-frontend.category-news slug="বাংলাদেশ"/>
       <x-frontend.international-news slug="আন্তর্জাতিক"/>
     <x-frontend.business-news />
    </main>

    <!-- Right Sidebar -->
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
@endsection

