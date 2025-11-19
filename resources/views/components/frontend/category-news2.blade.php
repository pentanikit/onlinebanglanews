
@if($categoriesNews2->isNotEmpty())

    @php
        $first   = $categoriesNews2->first();      // প্রথম নিউজ
        $others = $categoriesNews2->skip(1);      // বাকি সব নিউজ
    @endphp

    {{-- Lead news --}}
    <article class="lead-news" >
        <img src="{{ asset('storage').'/'. $first->featuredImage->file_path ?? '' }}" style="width: 100%; height: auto; object-fit:cover;" alt="{{ $first->title ?? 'Lead News' }}">
        
        <h2>{{ $first->title }}</h2>

        <p class="meta">
            {{ $first->author->name ?? 'স্টাফ রিপোর্টার' }} |
            {{ $first->published_at?->format('d F Y') }}
        </p>

        <p class="excerpt">
            {{ $first->excerpt ?? Str::limit(strip_tags($first->content), 150) }}
        </p>
    </article>

    {{-- 2-column news grid --}}
    @if($others->isNotEmpty())
        <div class="news-grid">
            @foreach($others as $item)
                <article class="news-card">
                    <img src="{{ asset('storage').'/'. $item->featuredImage->file_path ?? '' }}" style="max-width: 240px; height: auto; object-fit:cover;" alt="{{ $item->title ?? 'Lead News' }}">
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
