{{-- @forelse ($breaking as $item)
        <article class="lead-news">
        
            <img src="" alt="Lead News">
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
@empty
    
@endforelse --}}




@if($breaking->isNotEmpty())

    @php
        $lead   = $breaking->first();      // প্রথম নিউজ
        $others = $breaking->skip(1);      // বাকি সব নিউজ
    @endphp

    {{-- Lead news --}}
    <article class="lead-news">
        <img src="{{ asset('storage').'/'. $lead->featuredImage->file_path ?? '' }}" style="max-width: 400px; height: auto; object-fit:cover;" alt="{{ $lead->title ?? 'Lead News' }}">
        
        <h2>{{ $lead->title }}</h2>

        <p class="meta">
            {{ $lead->author->name ?? 'স্টাফ রিপোর্টার' }} |
            {{ $lead->published_at?->format('d F Y') }}
        </p>

        <p class="excerpt">
            {{ $lead->excerpt ?? Str::limit(strip_tags($lead->content), 150) }}
        </p>
    </article>

    {{-- 2-column news grid --}}
    @if($others->isNotEmpty())
        <div class="news-grid">
            @foreach($others as $item)
                <article class="news-card">
                    <img src="{{ asset('storage').'/'. $item->featuredImage->file_path ?? '' }}" style="max-width: 240px; height: auto; object-fit:cover;" alt="{{ $lead->title ?? 'Lead News' }}">
                    <h3>{{ $item->title }}</h3>

                    <p class="meta">
                        {{ $item->author->name ?? 'স্টাফ রিপোর্টার' }}
                    </p>

                    <p>
                        {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
                    </p>
                </article>
            @endforeach
        </div>
    @endif

@else
    {{-- যদি কোনো breaking news না থাকে --}}
    <p>কোনো ব্রেকিং নিউজ পাওয়া যায়নি।</p>
@endif
