@extends('frontend.layout')
@section('pages')
      <!-- Main Layout -->
  <div class="container main-layout">
    <!-- Left/Main Column -->
    <main class="content">
      <!-- Lead News -->
      <x-frontend.breaking-news />

      <!-- Category Block -->
      <section class="category-block">
        <div class="section-title">
          <h2>জাতীয়</h2>
          <a href="#">সব খবর »</a>
        </div>
        <div class="category-grid">
          <article>
            <h4>বন্যায় ক্ষতিগ্রস্ত কৃষকদের জন্য বিশেষ প্রণোদনা</h4>
            <p>সরকার বলছে, এবার পুনর্বাসনে আলাদা তহবিল গঠন করা হয়েছে...</p>
          </article>
          <article>
            <h4>চট্টগ্রাম বন্দরের আধুনিকায়ন প্রকল্পে গতি</h4>
            <p>চট্টগ্রাম বন্দর কর্তৃপক্ষ জানিয়েছে নতুন ক্রেইন আসায়...</p>
          </article>
          <article>
            <h4>নিরাপদ সড়ক চাই: শিক্ষার্থীদের মানববন্ধন</h4>
            <p>রাজধানীর বিভিন্ন স্থানে শিক্ষার্থীরা প্রতিবাদ কর্মসূচি পালন করেছে...</p>
          </article>
        </div>
      </section>
    </main>

    <!-- Right Sidebar -->
    <aside class="sidebar">
      <div class="widget">
        <h3>সর্বশেষ</h3>
        <ul class="list">
          <li><a href="#">সরকারি চাকরিতে বয়স বাড়ানোর দাবিতে মানববন্ধন</a></li>
          <li><a href="#">বিমানবন্দরে স্বর্ণ জব্দ</a></li>
          <li><a href="#">রাজধানীতে যানজট বেড়েছে</a></li>
          <li><a href="#">ঢাবিতে ভর্তি পরীক্ষা অনুষ্ঠিত</a></li>
          <li><a href="#">ই-কমার্স নীতিমালা হালনাগাদ</a></li>
        </ul>
      </div>

      <div class="widget">
        <h3>জনপ্রিয়</h3>
        <ul class="list">
          <li><a href="#">দামের মধ্যে যেসব স্মার্টফোন বাজারে</a></li>
          <li><a href="#">শীতে ত্বকের যত্ন নেবেন যেভাবে</a></li>
          <li><a href="#">বাংলাদেশ দলের বিশ্বকাপ বিশ্লেষণ</a></li>
        </ul>
      </div>

      <div class="widget ad-widget">
        <span>300x250 AD</span>
      </div>
    </aside>
  </div>
@endsection

