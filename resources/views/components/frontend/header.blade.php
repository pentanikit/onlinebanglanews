<style>
  .header {
    padding: 0px 0;
    /* border-bottom: 1px solid #eee; */
}

.header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}

.header-logo a {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}

.logo h1 {
    margin: 0;
}

.logo img {
    display: inline-block;
    max-height: 80px;
    height: auto;
    width: auto;
}

/* Right side latest news container */
.header-latest {
    display: flex;
    align-items: center;
    gap: 16px;              /* space between the 3 items */
}

/* Each small news item */
.header-latest-item {
    width: 200px;       /* tune if needed */
    
}

.header-latest-link {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

/* Thumbnail */
.header-latest-thumb {
    width: 60px;
    height: 52px;
    border-radius: 2px;
    overflow: hidden;
    flex-shrink: 0;
}

.header-latest-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Text + round red icon (like your screenshot) */
.header-latest-text-wrap {
    display: flex;
    align-items: flex-start;
    gap: 4px;
}

.header-latest-icon {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 2px solid #e53935;   /* red circle */
    display: inline-block;
    margin-top: 2px;
}

/* If you want a tiny play icon inside:
.header-latest-icon::before {
    content: "▶";
    font-size: 9px;
    color: #e53935;
    position: relative;
    left: 2px;
    top: -1px;
}
*/

.header-latest-text {
    font-size: 13px;
    line-height: 1.3;
    color: #222;
    display: -webkit-box;
    -webkit-line-clamp: 2;       /* max 2 lines then ... */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Hover effect */
.header-latest-link:hover .header-latest-text {
    color: #d32f2f;
}

/* Mobile: stack under logo */
@media (max-width: 768px) {
    .header-inner {
        flex-direction: column;
        align-items: flex-start;
    }

    .header-latest {
        width: 100%;
        justify-content: flex-start;
        flex-wrap: wrap;
        gap: 8px;
    }

    .header-latest-item {
        width: calc(50% - 8px);
    }
}

</style>

<header class="header">
    <div class="container header-inner">

        {{-- Left: Logo --}}
        <div class="header-logo">
            <a href="{{ route('home') }}">
                <div class="logo">
                    <h1>
                        @if ($headerLogo->isNotEmpty())
                            <img src="{{ logo() }}" class="px-1" width="220" height="80" alt="Site Logo">
                             
                        @else
                            <span>Online Bangla News</span>
                        @endif
                    </h1>
                    {{ \Carbon\Carbon::now('Asia/Dhaka')->locale('bn')->isoFormat('dddd, DD MMMM YYYY') . ' | ঢাকা' }}
                    <p class="tagline"></p>
                </div>
            </a>
        </div>

        {{-- Right: Latest 3 news like your screenshot --}}
        <div class="header-latest">
            @php
                use App\Models\Post;

                $latestPosts = Post::with('featuredImage')
                    ->latest()
                    ->take(4)
                    ->get();
            @endphp

            @foreach($latestPosts as $post)
                <div class="header-latest-item">
                    <a href="{{ route('singleNews', $post->id) }}" class="header-latest-link">
                        <div class="header-latest-thumb">
                            @php
                                // adjust according to your relationship field (url/path/image)
                                $img = $post->featuredImage->file_path ?? $post->featuredImage->file_path ?? null;
                            @endphp

                            @if($img)
                                <img src="{{ asset('storage/'.$img) }}" alt="{{ $post->title }}">
                            @else
                                <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $post->title }}">
                            @endif
                        </div>

                        <div class="header-latest-text-wrap">
                            <span class="header-latest-icon"></span>
                            <span class="header-latest-text">
                                {{ $post->title }}
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</header>
