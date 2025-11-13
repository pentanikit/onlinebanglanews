<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <title>বাংলা সংবাদপত্র</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- Google Font (optional) -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Top Bar -->
  <div class="topbar">
    <div class="container topbar-inner">
      <div class="top-left">
        মঙ্গলবার, ১১ নভেম্বর ২০২৫ | ঢাকা
      </div>
      <div class="top-right">
        <a href="#">আজকের পত্রিকা</a>
        <a href="#">ই-পেপার</a>
        <a href="#">যোগাযোগ</a>
      </div>
    </div>
  </div>
    <!-- Header -->
  <header class="header">
    <div class="container header-inner">
      <div class="logo">
        <h1>দৈনিক সময়বার্তা</h1>
        <p class="tagline">সত্য ও নির্ভরযোগ্য সংবাদ</p>
      </div>
      <div class="banner-ad">
        <span>728x90 AD</span>
      </div>
    </div>
  </header>
    <!-- Nav -->
  <nav class="main-nav">
    <div class="container nav-inner">
      <a href="#" class="active">প্রচ্ছদ</a>
      <a href="#">জাতীয়</a>
      <a href="#">আন্তর্জাতিক</a>
      <a href="#">অর্থনীতি</a>
      <a href="#">খেলাধুলা</a>
      <a href="#">বিনোদন</a>
      <a href="#">ফিচার</a>
      <a href="#">মতামত</a>
    </div>
  </nav>

  @yield('pages')

    <!-- Footer -->
  <footer class="footer">
    <div class="container footer-inner">
      <p>© ২০২৫ দৈনিক সময়বার্তা | সম্পাদক ও প্রকাশক: এমদাদুল হক (ডেমো)</p>
      <p>কারিগরি সহায়তায়: Pentanik IT</p>
    </div>
  </footer>
</body>
</html>