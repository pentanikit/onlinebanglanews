<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <title>বাংলা সংবাদপত্র</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- Google Font (optional) --
    >
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
  <x-frontend.header />
    <!-- Nav -->
  <x-frontend.navigation />

  @yield('pages')

    <!-- Footer -->
  <footer class="footer">
    <div class="container footer-inner">
      <p>© ২০২৫ দৈনিক অনলাইন বাংলা নিউজ  | সম্পাদক ও প্রকাশক: রাকিবুল ইসলাম রাকিব </p>
      <p>কারিগরি সহায়তায়: Pentanik IT</p>
    </div>
  </footer>
</body>
</html>