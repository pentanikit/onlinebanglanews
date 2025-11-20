<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <title>অনলাইন বাংলা নিউজ </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="icon" href="{{ asset('storage').'/'.'uploads/media/o4z8uqN8U4mikSk1QbhY0WQxRROEymTee9J3mEue.png' }}">
  <!-- Google Font (optional) --
    >
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Top Bar -->
  <div class="topbar">
    <div class="container topbar-inner">
      <div class="top-left">
        {{ \Carbon\Carbon::now('Asia/Dhaka')->locale('bn')->isoFormat('dddd, DD MMMM YYYY') . ' | ঢাকা' }}

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
      <p>© কপিরাইট <?php echo date('Y'); ?> অনলাইন বাংলা নিউজ  </p>
      <p>কারিগরি সহায়তায়: Pentanik IT</p>
    </div>
  </footer>
</body>
</html>