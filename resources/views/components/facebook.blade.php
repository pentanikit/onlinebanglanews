        <div class="fb-fallback-box">
            <!-- Top: logo + text -->
            <div class="fb-fallback-header">
                <div class="fb-fallback-logo">
                    <img src="{{ favicon() }}" alt="Facebook" class="fb-fallback-logo-img">
                </div>

                <div class="fb-fallback-text">
                    <div class="fb-fallback-title">Daily Online Bangla News</div>
                    <div class="fb-fallback-subtitle">
                        ফেসবুকে যুক্ত থাকুন, সর্বশেষ খবর পান এক ক্লিকেই।
                    </div>
                </div>
            </div>

            <!-- Middle: button -->
            <div class="fb-fallback-button-wrap">
                <a href="https://www.facebook.com/dailyonlinebanglanews" target="_blank" class="fb-fallback-btn">
                    <span class="fb-fallback-btn-icon">👍</span>
                    <span>Visit Facebook Page</span>
                </a>
            </div>

            <!-- Bottom: cover image -->
            <div class="fb-fallback-cover">
                <img src="{{ asset('storage').'/uploads/cover.jpg' }}"
                    id="bottom-cover"
                    alt="Daily Online Bangla News Cover"
                    class="fb-fallback-cover-img">
            </div>
        </div>

<style>
    .fb-fallback-box {
    border: 1px solid #e5e5e5;
    padding: 14px;
    border-radius: 12px;
    background: radial-gradient(circle at top left, #f0f4ff, #f9f9f9);
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100%;
    max-width: 380px;   /* will shrink on mobile, stay nice in sidebar */
    box-sizing: border-box;
}

/* Header */
.fb-fallback-header {
    display: flex;
    align-items: center;
    gap: 12px;
}

.fb-fallback-logo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05);
}

.fb-fallback-logo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.fb-fallback-title {
    font-weight: 700;
    font-size: 15px;
    color: #111;
}

.fb-fallback-subtitle {
    font-size: 13px;
    color: #666;
}

/* Button */
.fb-fallback-button-wrap {
    margin-top: 4px;
}

.fb-fallback-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: #1877f2;
    color: #fff;
    text-decoration: none;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 6px 12px rgba(24, 119, 242, 0.25);
}

.fb-fallback-btn-icon {
    font-size: 16px;
}

/* Cover image: always fits, keeps aspect ratio */
.fb-fallback-cover {
    margin-top: 8px;
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
    aspect-ratio: 16 / 9;   /* responsive height based on width */
}

.fb-fallback-cover-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* 📱 Mobile tweaks */
@media (max-width: 480px) {
    .fb-fallback-box {
        padding: 10px;
        border-radius: 10px;
    }

    .fb-fallback-title {
        font-size: 14px;
    }

    .fb-fallback-subtitle {
        font-size: 12px;
    }

    .fb-fallback-btn {
        width: 100%;
        justify-content: center;
        font-size: 13px;
        padding: 8px 10px;
    }
}
</style>