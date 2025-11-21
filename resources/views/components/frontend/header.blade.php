    <!-- Header -->
  <header class="header">
    <div class="container header-inner">
      <a href="{{ route('home') }}">
         <div class="logo">
          <h1> 
            @if ($headerLogo->isNotEmpty())
              <img src="{{  asset('storage').'/'.$headerLogo[0] }}" alt="" srcset="">
            @else
                <span>Online Bangla News</span>
            @endif
            
          </h1>
          <p class="tagline"></p>
        </div>
      </a>
     
      
    </div>
  </header>