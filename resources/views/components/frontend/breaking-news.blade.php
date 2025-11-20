@if ($breaking->isNotEmpty())

    @php
        $lead = $breaking->first(); // প্রথম নিউজ
        $others = $breaking->skip(1); // বাকি সব নিউজ
    @endphp

    {{-- Lead news --}}
    <article class="lead-news">
        <a href="{{ route('singleNews', $lead->slug) }}">
            <img src="{{ asset('storage') . '/' . $lead->featuredImage->file_path ?? '' }}"
                style="width: 100%; height: auto; object-fit:cover;" alt="{{ $lead->title ?? 'Lead News' }}">

            <h2>{{ $lead->title }}</h2>

            <p class="meta">
                {{ $lead->author->name ?? 'স্টাফ রিপোর্টার' }} |
                {{ $lead->published_at?->format('d F Y') }}
            </p>

            <p class="excerpt">
                {{ $lead->excerpt ?? Str::limit(strip_tags($lead->content), 150) }}
            </p>
        </a>

    </article>

    {{-- 2-column news grid --}}
    @if ($others->isNotEmpty())
        <div class="news-grid">
            @foreach ($others as $item)
            <a href="{{ route('singleNews', $item->slug) }}">
                 <article class="news-card" style="height: 440px;">
                    <img src="{{ asset('storage') . '/' . $item->featuredImage->file_path ?? '' }}"
                        style="width: 100%; height: auto; object-fit:cover;"
                        alt="{{ $lead->title ?? 'Lead News' }}">
                    <h3>{{ $item->title }}</h3>

                    <p class="meta">
                        {{ $item->author->name ?? 'স্টাফ রিপোর্টার' }}
                    </p>

                    <p>
                        {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
                    </p>
                </article>
            </a>
               
            @endforeach
        </div>
    @endif
@else
    {{-- যদি কোনো breaking news না থাকে --}}
    <p>কোনো ব্রেকিং নিউজ পাওয়া যায়নি।</p>
@endif
