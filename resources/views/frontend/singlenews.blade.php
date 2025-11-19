@extends('frontend.layout')
@section('pages')
     <div class="container main-layout">
         <x-frontend.single-news :post="$post" />
     </div>
      
@endsection