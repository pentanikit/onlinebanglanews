@extends('frontend.layout')
@section('pages')
      <!-- Main Layout -->
  <div class="container main-layout">
    <!-- Left/Main Column -->
    <main class="content">
      <!-- Lead News -->
      <article class="lead-news">
        <img src="https://via.placeholder.com/900x400?text=Lead+News" alt="Lead News">
        <h2>বিশ্ববাজারে জ্বালানির দাম কমলেও দেশে সমন্বয়ের অপেক্ষায় সাধারণ মানুষ</h2>
        <p class="meta">স্টাফ রিপোর্টার | ১১ নভেম্বর ২০২৫</p>
        <p class="excerpt">
          বিশ্ববাজারে তেলের দাম কমতে থাকায় বাংলাদেশেও জ্বালানি দর সমন্বয়ের দাবি উঠেছে। বিশেষজ্ঞরা বলছেন,
          পরিবহন ও বিদ্যুৎ খাতে এর প্রভাব পড়লে সাধারণ মানুষের জীবনযাত্রার ব্যয় কিছুটা কমে আসবে...
        </p>
      </article>

      <!-- 2-column news grid -->
      <div class="news-grid">
        <article class="news-card">
          <h3>সংসদে নতুন কর কাঠামো পেশ, কী থাকছে আপনার জন্য</h3>
          <p class="meta">জাতীয় ডেস্ক</p>
          <p>নতুন বাজেটে করমুক্ত আয়ের সীমা বাড়ানোর প্রস্তাব এসেছে, তবে কর ফাঁকি রোধে কড়াকড়িও থাকছে...</p>
        </article>
        <article class="news-card">
          <h3>টি-টোয়েন্টি সিরিজে বাংলাদেশের দারুণ জয়</h3>
          <p class="meta">খেলা</p>
          <p>সিরিজের দ্বিতীয় ম্যাচে ৭ উইকেটে জয় পেয়ে সিরিজ নিশ্চিত করলো বাংলাদেশ ক্রিকেট দল...</p>
        </article>
        <article class="news-card">
          <h3>ঢাকায় গ্যাস সংকট, শিল্প মালিকদের ক্ষোভ</h3>
          <p class="meta">অর্থনীতি</p>
          <p>টানা গ্যাস সংকটে উৎপাদন ব্যাহত হওয়ায় সংশ্লিষ্ট শিল্পমালিকরা দ্রুত সমাধানের দাবি জানিয়েছেন...</p>
        </article>
        <article class="news-card">
          <h3>শীত এলেই বাড়বে শিশুর নিউমোনিয়া</h3>
          <p class="meta">স্বাস্থ্য</p>
          <p>ডাক্তাররা বলছেন, ঠান্ডায় শিশুদের বাড়তি যত্ন নেওয়া জরুরি, না হলে নিউমোনিয়ার ঝুঁকি বাড়বে...</p>
        </article>
      </div>

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

