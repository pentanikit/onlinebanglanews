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

      <div class="widget ad-widget" style="width: 300px; height: 250px;">
        <span>300x250 AD</span>
      </div>
      <div class="widget ad-widget" style="width: 300px; height: 250px;">
        <span>300x250 AD</span>
      </div>
      <div class="widget ad-widget" style="width: 300px; height: 250px;">
        <span>300x250 AD</span>
      </div>
      <div class="widget ad-widget" style="width: 300px; height: 250px;">
        <span>300x250 AD</span>
      </div>
    </aside>
  </div>
@endsection

