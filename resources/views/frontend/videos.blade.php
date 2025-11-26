<section class="video-news-section">
  <!-- Left: Main video player -->
  <div class="video-news-main">
    <div class="video-player-wrapper">
      <iframe
        id="newsVideoPlayer"
        src="https://www.youtube.com/embed/VIDEO_ID_1?rel=0"
        title="News Video"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen>
      </iframe>
    </div>
    <h3 id="videoTitle" class="video-main-title">
      পদ্মা সেতুর নতুন টোল নীতিমালা প্রকাশ
    </h3>
    <p id="videoMeta" class="video-main-meta">
      স্টাফ রিপোর্টার | ১১ নভেম্বর ২০২৫
    </p>
  </div>

  <!-- Right: Playlist list -->
  <div class="video-news-list">
    <article class="cat-item active"
             data-video-id="VIDEO_ID_1"
             data-title="পদ্মা সেতুর নতুন টোল নীতিমালা প্রকাশ"
             data-meta="স্টাফ রিপোর্টার | ১১ নভেম্বর ২০২৫">
      <h3>পদ্মা সেতুর নতুন টোল নীতিমালা প্রকাশ</h3>
      <p class="meta">স্টাফ রিপোর্টার | ১১ নভেম্বর ২০২৫</p>
      <p>নতুন নীতিমালায় ব্যক্তিগত গাড়ি, বাস ও ট্রাকের জন্য আলাদা হার নির্ধারণ করা হয়েছে...</p>
    </article>

    <article class="cat-item"
             data-video-id="VIDEO_ID_2"
             data-title="চট্টগ্রামে বন্দর আধুনিকায়নে আরও বরাদ্দ"
             data-meta="নিজস্ব প্রতিবেদক">
      <h3>চট্টগ্রামে বন্দর আধুনিকায়নে আরও বরাদ্দ</h3>
      <p class="meta">নিজস্ব প্রতিবেদক</p>
      <p>বন্দর কর্তৃপক্ষ বলছে এই বরাদ্দে কনটেইনার হ্যান্ডলিং ক্ষমতা দ্বিগুণ হবে...</p>
    </article>

    <article class="cat-item"
             data-video-id="VIDEO_ID_3"
             data-title="বন্যায় ক্ষতিগ্রস্তদের মাঝে ত্রাণ বিতরণ অব্যাহত"
             data-meta="ফেনী প্রতিনিধি">
      <h3>বন্যায় ক্ষতিগ্রস্তদের মাঝে ত্রাণ বিতরণ অব্যাহত</h3>
      <p class="meta">ফেনী প্রতিনিধি</p>
      <p>স্থানীয় প্রশাসন, স্বেচ্ছাসেবী সংগঠন ও সেনাবাহিনীর যৌথ তত্ত্বাবধানে ত্রাণ বিতরণ চলছে...</p>
    </article>

    <article class="cat-item"
             data-video-id="VIDEO_ID_4"
             data-title="স্মার্ট বাংলাদেশ কর্মপরিকল্পনায় নতুন ধাপ"
             data-meta="জাতীয় ডেস্ক">
      <h3>স্মার্ট বাংলাদেশ কর্মপরিকল্পনায় নতুন ধাপ</h3>
      <p class="meta">জাতীয় ডেস্ক</p>
      <p>ডিজিটালাইজেশন থেকে স্মার্ট সিস্টেমে যাওয়ার রোডম্যাপ প্রকাশ করেছে মন্ত্রণালয়...</p>
    </article>

    <article class="cat-item"
             data-video-id="VIDEO_ID_5"
             data-title="সড়ক নিরাপত্তায় রাজধানীতে বিশেষ অভিযান"
             data-meta="নিজস্ব প্রতিবেদক">
      <h3>সড়ক নিরাপত্তায় রাজধানীতে বিশেষ অভিযান</h3>
      <p class="meta">নিজস্ব প্রতিবেদক</p>
      <p>অবৈধ পার্কিং ও লাইসেন্সবিহীন চালকদের বিরুদ্ধে জোরালো অভিযান শুরু হয়েছে...</p>
    </article>
  </div>
</section>

<!-- Styles -->
<style>
.video-news-section {
  display: grid;
  grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
  gap: 16px;
  margin: 16px 0;
}

/* Main video */
.video-news-main {
  background: #ffffff;
  border-radius: 12px;
  padding: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.video-player-wrapper {
  position: relative;
  padding-bottom: 56.25%; /* 16:9 */
  height: 0;
  border-radius: 10px;
  overflow: hidden;
  background: #000;
}

#newsVideoPlayer {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}

.video-main-title {
  font-size: 18px;
  margin-top: 10px;
  margin-bottom: 4px;
}

.video-main-meta {
  font-size: 13px;
  color: #777;
  margin-bottom: 4px;
}

/* Playlist list */
.video-news-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.video-news-list .cat-item {
  background: #ffffff;
  border-radius: 10px;
  padding: 10px;
  border: 1px solid #eee;
  cursor: pointer;
  transition: all 0.2s ease;
}

.video-news-list .cat-item:hover {
  border-color: #d0d7ff;
  background: #f7f8ff;
  transform: translateY(-1px);
}

.video-news-list .cat-item.active {
  border-color: #4f46e5;
  box-shadow: 0 0 0 1px rgba(79,70,229,0.15);
  background: #f3f4ff;
}

.video-news-list .cat-item h3 {
  font-size: 14px;
  margin: 0 0 4px;
}

.video-news-list .cat-item .meta {
  font-size: 12px;
  color: #777;
  margin: 0 0 4px;
}

.video-news-list .cat-item p {
  font-size: 13px;
  margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .video-news-section {
    grid-template-columns: 1fr;
  }
}
</style>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const player = document.getElementById('newsVideoPlayer');
  const titleEl = document.getElementById('videoTitle');
  const metaEl = document.getElementById('videoMeta');
  const items = document.querySelectorAll('.video-news-list .cat-item');

  items.forEach(function (item) {
    item.addEventListener('click', function () {
      const videoId = this.getAttribute('data-video-id');
      const title = this.getAttribute('data-title');
      const meta = this.getAttribute('data-meta');

      if (!videoId) return;

      // Update iframe src (autoplay new video).
      player.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0';

      // Update main title & meta.
      if (titleEl) titleEl.textContent = title || '';
      if (metaEl) metaEl.textContent = meta || '';

      // Active state
      items.forEach(i => i.classList.remove('active'));
      this.classList.add('active');
    });
  });
});
</script>
