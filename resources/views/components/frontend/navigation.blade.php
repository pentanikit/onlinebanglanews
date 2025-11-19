<!-- Nav -->
<nav class="main-nav">
  <div class="container nav-inner">

    @forelse ($nav as $index => $item)
      @php
          // Link বানানো
          if ($index === 0) {
              // প্রথম আইটেম = হোম
              $href = url('/'); // বা route('home') যদি থাকে
          } else {
              // বাকি আইটেম = ক্যাটাগরি
              $href = url('categories/' . $item->slug); // নিজের রুট অনুযায়ী ঠিক করে নাও
          }

          // active ক্লাস নির্ধারণ
          if ($index === 0) {
              // হোম পেজে থাকলে প্রথম আইটেম active
              $isActive = request()->is('/') || request()->routeIs('home');
          } else {
              // ক্যাটাগরি পেজে থাকলে সেই ক্যাটাগরি active
              $isActive = request()->is('categories/' . $item->slug);
          }
      @endphp

      <a href="{{ $href }}" class="{{ $isActive ? 'active' : '' }}">
          {{ $item->name }}
      </a>
    @empty
      <a href="#">Not available</a>
    @endforelse

  </div>
</nav>





