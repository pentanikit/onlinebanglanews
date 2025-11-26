<div class="yt-fallback-box">
    <!-- Top: logo + text -->
    <div class="yt-fallback-header">
        <div class="yt-fallback-logo">
            {{-- Use your own YouTube icon here if you want --}}
            <img src="{{ favicon() }}" alt="YouTube" class="yt-fallback-logo-img">
        </div>

        <div class="yt-fallback-text">
            <div class="yt-fallback-title">Daily Online Bangla News - YouTube</div>
            <div class="yt-fallback-subtitle">
                ব্রেকিং নিউজ ও বিস্তারিত বিশ্লেষণ দেখুন আমাদের অফিসিয়াল ইউটিউব চ্যানেলে।
            </div>
        </div>
    </div>

    <!-- Middle: Subscribe button -->
    <div class="yt-fallback-button-wrap">
        {{-- Replace CHANNEL_ID_HERE with your real channel ID --}}
        <a href="https://www.youtube.com/channel/UCo_Jx8k1kTkiElBGLfbOQ8A?sub_confirmation=1"
           target="_blank"
           class="yt-fallback-btn">
            <span class="yt-fallback-btn-icon">📺</span>
            <span>Subscribe on YouTube</span>
        </a>
    </div>

    <!-- Bottom: video preview (intro / latest video) -->
    {{-- <div class="yt-fallback-video">
       
        <iframe
            class="yt-fallback-video-iframe"
            src="https://www.youtube.com/embed/VIDEO_ID_HERE"
            title="Daily Online Bangla News YouTube"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen>
        </iframe>
    </div> --}}
</div>

<style>
    .yt-fallback-box {
    border: 1px solid #e5e5e5;
    padding: 14px;
    border-radius: 12px;
    background: radial-gradient(circle at top left, #ffecec, #fdf9f9);
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100%;
    max-width: 380px;   /* works nicely in sidebar or grid */
    box-sizing: border-box;
}

/* Header */
.yt-fallback-header {
    display: flex;
    align-items: center;
    gap: 12px;
}

.yt-fallback-logo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05);
    object-fit: contain;
}

.yt-fallback-logo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.yt-fallback-title {
    font-weight: 700;
    font-size: 15px;
    color: #111;
}

.yt-fallback-subtitle {
    font-size: 13px;
    color: #666;
}

/* Button */
.yt-fallback-button-wrap {
    margin-top: 4px;
}

.yt-fallback-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: #ff0000;
    color: #fff;
    text-decoration: none;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 6px 12px rgba(255, 0, 0, 0.25);
}

.yt-fallback-btn-icon {
    font-size: 16px;
}

/* Video: fully responsive */
.yt-fallback-video {
    margin-top: 8px;
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
    aspect-ratio: 16 / 9; /* responsive height */
}

.yt-fallback-video-iframe {
    width: 100%;
    height: 100%;
    display: block;
}

/* 📱 Mobile tweaks */
@media (max-width: 480px) {
    .yt-fallback-box {
        padding: 10px;
        border-radius: 10px;
    }

    .yt-fallback-title {
        font-size: 14px;
    }

    .yt-fallback-subtitle {
        font-size: 12px;
    }

    .yt-fallback-btn {
        width: 100%;
        justify-content: center;
        font-size: 13px;
        padding: 8px 10px;
    }
}

</style>