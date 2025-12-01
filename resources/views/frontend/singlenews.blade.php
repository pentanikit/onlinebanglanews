@extends('frontend.layout')
@section('meta_title', ($post->meta_title ?? $post->title) . ' | অনলাইন বাংলা নিউজ')

@section('meta_description', $post->meta_description
    ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 160))

@section('meta_keywords', $post->meta_title ?? 'অনলাইন বাংলা নিউজ, ' . ($post->category->name ?? 'সংবাদ'))
@section('pages')
     <div class="container main-layout">
         <x-frontend.single-news :post="$post" />
     </div>
      
@endsection