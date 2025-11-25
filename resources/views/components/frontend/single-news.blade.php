    <main class="content">

        {{-- @dd($singlePost->tags[0]->name) --}}

        <article class="single-post">
            <h1>{{ $singlePost->title }}</h1>
            <p class="single-meta" style="font-size: 10px;">{{ $singlePost->author->name ?? 'স্টাফ রিপোর্টার' }} | {{ \App\Helpers\BanglaDate::format($singlePost->created_at) }}</p>
            <img src="{{ asset('storage') . '/' . $singlePost->featuredImage->file_path }}"
                style="max-width: 100%; height:400px;" class="single-cover" alt="">

            <div class="single-body">
                {{-- {{ $singlePost->content ?? $singlePost->excerpt }} --}}
                 {!! nl2br(e($singlePost->content ?? $singlePost->excerpt)) !!}

            </div>

            <!-- Tags / category -->
            <div class="single-tags">
                <span>ট্যাগ:</span>

                @if ($singlePost->tags->isNotEmpty())
                    @foreach (explode(',', $singlePost->tags[0]->name) as $tag)
                        @php $tag = trim($tag); @endphp

                        @if ($tag !== '')
                            <a href="#">{{ $tag }}</a>

                            {{-- যদি ট্যাগ পেজ থাকে, তাহলে এমনও করতে পারো:
                      <a href="{{ route('tag.posts', ['tag' => $tag]) }}">{{ $tag }}</a>
                      --}}
                        @endif
                    @endforeach
                @else
                    <p>No tags found</p>
                @endif
            </div>

        </article>



    </main>

    <aside class="sidebar">
      <x-frontend.latest-news />

      <div class="widget" >
        <h3>জনপ্রিয়</h3>
        <ul class="list">
          <li><a href="#">দামের মধ্যে যেসব স্মার্টফোন বাজারে</a></li>
          <li><a href="#">শীতে ত্বকের যত্ন নেবেন যেভাবে</a></li>
          <li><a href="#">বাংলাদেশ দলের বিশ্বকাপ বিশ্লেষণ</a></li>
        </ul>
      </div>

      @php $ad = ad1('home_sidebar'); @endphp
      @if($ad && $ad->image)
        <div class="widget ad-widget">
          <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 1">
        </div>
      @endif

      <x-frontend.sport-news />

      @php $ad = ad2('home_sidebar'); @endphp
      @if($ad && $ad->image)
        <div class="widget ad-widget">
          <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 2">
        </div>
      @endif

      <x-frontend.celeb-news />

      @php $ad = ad3('home_sidebar'); @endphp
      @if($ad && $ad->image)
        <div class="widget ad-widget">
          <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 3">
        </div>
      @endif

      <x-frontend.job-news />

      @php $ad = ad4('home_sidebar'); @endphp
      @if($ad && $ad->image)
        <div class="widget ad-widget">
          <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 4">
        </div>
      @endif

    </aside>
