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
    <x-aside  />
  </div>


@endsection

