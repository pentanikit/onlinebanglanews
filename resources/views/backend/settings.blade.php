@extends('backend.layout')
@section('content')
    <!-- Settings -->
<section id="view-settings" class="view ">
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">সেটিংস</h5>
    </div>
    <div class="card-body">
    <form id="settingsForm" class="row g-3"
        action="{{ route('admin.settings.update') }}"
        method="POST">
        @csrf

        <!-- === Site Info === -->
        <div class="col-12">
        <h6 class="text-muted border-bottom pb-1 mb-2">সাইট ইনফরমেশন</h6>
        </div>

        <div class="col-md-6">
        <label class="form-label">সাইটের নাম</label>
        <input class="form-control" name="site_name"
                placeholder="অনলাইন বাংলা নিউজ"
                value="{{ old('site_name', seo_setting('site_name', 'অনলাইন বাংলা নিউজ')) }}">
        <small class="text-muted">Browser title বারেও এটা fallback হিসেবে ব্যবহার হবে।</small>
        </div>

        <div class="col-md-6">
        <label class="form-label">ট্যাগলাইন</label>
        <input class="form-control" name="site_tagline"
                placeholder="সত্যের পথে, নির্ভীক সাংবাদিকতা"
                value="{{ old('site_tagline', seo_setting('site_tagline', 'সত্যের পথে, নির্ভীক সাংবাদিকতা')) }}">
        </div>


        <!-- === Global SEO / Meta === -->
        <div class="col-12 mt-3">
        <h6 class="text-muted border-bottom pb-1 mb-2">গ্লোবাল SEO / Meta সেটিংস</h6>
        </div>

        <div class="col-md-6">
        <label class="form-label">ডিফল্ট Meta Title</label>
        <input class="form-control" name="site_meta_title"
                placeholder="অনলাইন বাংলা নিউজ | সর্বশেষ বাংলা খবর"
                value="{{ old('site_meta_title', seo_setting('site_meta_title', 'অনলাইন বাংলা নিউজ | সর্বশেষ বাংলা খবর')) }}">
        <small class="text-muted">
            যেসব পেজে আলাদা meta title সেট করা থাকবে না, সেগুলোর জন্য ব্যবহার হবে।
        </small>
        </div>

        <div class="col-md-6">
        <label class="form-label">ডিফল্ট Meta Keywords</label>
        <input class="form-control" name="site_meta_keywords"
                placeholder="বাংলা নিউজ, অনলাইন খবর, সর্বশেষ খবর"
                value="{{ old('site_meta_keywords', seo_setting('site_meta_keywords', 'বাংলা নিউজ, অনলাইন খবর, সর্বশেষ খবর')) }}">
        <small class="text-muted">কমা (,) দিয়ে আলাদা করে keyword লিখুন।</small>
        </div>

        <div class="col-12">
        <label class="form-label">ডিফল্ট Meta Description</label>
        <textarea class="form-control" name="site_meta_description" rows="3"
                    placeholder="অনলাইন বাংলা নিউজ – দেশের এবং দেশের বাইরের সর্বশেষ সংবাদ, বিশ্লেষণ, খেলা, বিনোদন সহ আরও অনেক কিছু।">{{ old('site_meta_description', seo_setting('site_meta_description', 'অনলাইন বাংলা নিউজ – দেশের এবং দেশের বাইরের সর্বশেষ সংবাদ, বিশ্লেষণ, খেলা, বিনোদন সহ আরও অনেক কিছু।')) }}</textarea>
        <small class="text-muted">প্রায় ১৫০–১৬০ ক্যারেক্টার রাখলে ভালো হয়।</small>
        </div>

        <!-- === Open Graph / Social Preview === -->
        <div class="col-12 mt-3">
        <h6 class="text-muted border-bottom pb-1 mb-2">সোশ্যাল প্রিভিউ / Open Graph</h6>
        </div>

        <div class="col-md-6">
        <label class="form-label">ডিফল্ট OG Title</label>
        <input class="form-control" name="og_default_title"
                placeholder="অনলাইন বাংলা নিউজ"
                value="{{ old('og_default_title', seo_setting('og_default_title', 'অনলাইন বাংলা নিউজ')) }}">
        </div>

        <div class="col-md-6">
        <label class="form-label">ডিফল্ট OG Image URL</label>
        <input class="form-control" name="og_default_image"
                placeholder="/storage/og-default.jpg"
                value="{{ old('og_default_image', seo_setting('og_default_image', '/storage/og-default.jpg')) }}">
        <small class="text-muted">Facebook/Twitter share না থাকলে এই ইমেজ যাবে।</small>
        </div>

        <div class="col-12">
        <label class="form-label">ডিফল্ট OG Description</label>
        <textarea class="form-control" name="og_default_description" rows="2"
                    placeholder="বিশ্বস্ত অনলাইন বাংলা সংবাদ পোর্টাল – সত্য ও নির্ভুল সংবাদ।">{{ old('og_default_description', seo_setting('og_default_description', 'বিশ্বস্ত অনলাইন বাংলা সংবাদ পোর্টাল – সত্য ও নির্ভুল সংবাদ।')) }}</textarea>
        </div>

        <!-- === Social Links === -->
        <div class="col-12 mt-3">
        <h6 class="text-muted border-bottom pb-1 mb-2">Social Media / যোগাযোগ</h6>
        </div>

        <div class="col-md-6">
        <label class="form-label">Facebook পেজ লিংক</label>
        <input class="form-control" name="facebook_link"
                placeholder="https://facebook.com/yourpage"
                value="{{ old('facebook_link', seo_setting('facebook_link')) }}">
        </div>

        <div class="col-md-6">
        <label class="form-label">YouTube চ্যানেল লিংক</label>
        <input class="form-control" name="youtube_link"
                placeholder="https://youtube.com/@yourchannel"
                value="{{ old('youtube_link', seo_setting('youtube_link')) }}">
        </div>

        <div class="col-md-6">
        <label class="form-label">Twitter / X লিংক</label>
        <input class="form-control" name="twitter_link"
                placeholder="https://x.com/username"
                value="{{ old('twitter_link', seo_setting('twitter_link')) }}">
        </div>

        <div class="col-md-6">
        <label class="form-label">Instagram লিংক</label>
        <input class="form-control" name="instagram_link"
                placeholder="https://instagram.com/username"
                value="{{ old('instagram_link', seo_setting('instagram_link')) }}">
        </div>

        <!-- === Contact Info === -->
        <div class="col-12 mt-3">
        <h6 class="text-muted border-bottom pb-1 mb-2">কনট্যাক্ট ইনফো</h6>
        </div>

        <div class="col-md-6">
        <label class="form-label">ইমেইল</label>
        <input class="form-control" name="contact_email"
                placeholder="news@example.com"
                value="{{ old('contact_email', seo_setting('contact_email')) }}">
        </div>

        <div class="col-md-6">
        <label class="form-label">ফোন নম্বর</label>
        <input class="form-control" name="contact_phone"
                placeholder="+8801XXXXXXXXX"
                value="{{ old('contact_phone', seo_setting('contact_phone')) }}">
        </div>

        <div class="col-12">
        <label class="form-label">অফিস ঠিকানা</label>
        <textarea class="form-control" name="contact_address" rows="2"
                    placeholder="হেড অফিসের ঠিকানা এখানে লিখুন">{{ old('contact_address', seo_setting('contact_address')) }}</textarea>
        </div>

        <!-- Save Button -->
        <div class="col-12">
        <button class="btn btn-primary" type="submit" id="settingsSaveBtn">
            <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
            <span class="btn-text">
            <i class="bi bi-save"></i> সেভ
            </span>
        </button>
        </div>
    </form>


    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('settingsForm');
    const btn  = document.getElementById('settingsSaveBtn');

    if (!form || !btn) return;

    const spinner = btn.querySelector('.spinner-border');
    const btnText = btn.querySelector('.btn-text');

    form.addEventListener('submit', function () {
    
        // Button disable করে দিচ্ছি, যেন ডাবল ক্লিক না হয়
        btn.disabled = true;

        // Spinner visible
        if (spinner) {
            spinner.classList.remove('d-none');
        }

        // Text change করতে চাইলে
        if (btnText) {
            btnText.innerHTML = 'সেভ হচ্ছে...';
        }
    });
});
</script>

@endsection

