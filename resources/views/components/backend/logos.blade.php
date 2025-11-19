<!-- Media -->
<section id="view-logos" class="view d-none">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">মিডিয়া লাইব্রেরি</h5>
      <small class="text-muted">এখান থেকে সাইটের লোগো এবং ফেভিকন পরিবর্তন করতে পারবেন</small>
    </div>

    <div class="card-body">
      <div class="row g-4 mb-4">
        <!-- Site Logo -->
        <div class="col-md-6">
          <div class="text-center">
            <h6 class="mb-2">ওয়েবসাইট লোগো</h6>
            <div class="border rounded p-3 d-inline-block bg-light">
              <img
                id="logoPreview"
                src="{{ asset('storage').'/'.$logo[0] ?? asset('images/default-logo.png') }}"
                alt="Current Logo"
                class="img-fluid"
                style="max-height: 120px; object-fit: contain;"
              >
            </div>
            <div class="mt-3">
              <label class="btn btn-primary mb-0">
                <i class="bi bi-upload"></i> লোগো আপলোড / পরিবর্তন
                <input
                  type="file"
                  id="logoUpload"
                  name="logo"
                  class="d-none"
                  accept="image/*"
                >
              </label>
              <small class="d-block mt-1 text-muted">
                JPG, PNG বা SVG ফাইল ব্যবহার করুন।
              </small>
            </div>
          </div>
        </div>

        <!-- Favicon -->
        <div class="col-md-6">
          <div class="text-center">
            <h6 class="mb-2">ফেভিকন (ব্রাউজার আইকন)</h6>
            <div class="border rounded p-3 d-inline-block bg-light">
              <img
                id="faviconPreview"
                src="{{ asset('storage').'/'.$favicon[0] ?? asset('images/default-favicon.png') }}"
                alt="Current Favicon"
                class="img-fluid"
                style="max-height: 64px; max-width: 64px; object-fit: contain;"
              >
            </div>
            <div class="mt-3">
              <label class="btn btn-primary mb-0">
                <i class="bi bi-upload"></i> ফেভিকন আপলোড / পরিবর্তন
                <input
                  type="file"
                  id="faviconUpload"
                  name="favicon"
                  class="d-none"
                  accept="image/*"
                >
              </label>
              <small class="d-block mt-1 text-muted">
                32×32 বা 64×64 PNG / ICO ফাইল হলে ভালো।
              </small>
            </div>
          </div>
        </div>
      </div>

      <hr>

      <!-- অন্য মিডিয়া থাকলে এখানে দেখাবেন -->
      <h6 class="mb-3">অন্যান্য মিডিয়া লাইব্রেরি</h6>
      <div id="mediaGrid" class="row g-3"></div>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const uploadUrl = "{{ route('media.store') }}"; // Laravel route
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

    if (!csrfToken) {
      console.warn('CSRF token not found in <meta name="csrf-token">');
    }

    const config = [
      {
        inputId: 'logoUpload',
        previewId: 'logoPreview',
        fieldName: 'logo',
        type: 'logo'
      },
      {
        inputId: 'faviconUpload',
        previewId: 'faviconPreview',
        fieldName: 'favicon',
        type: 'favicon'
      }
    ];

    config.forEach(function (item) {
      const inputEl   = document.getElementById(item.inputId);
      const previewEl = document.getElementById(item.previewId);

      if (!inputEl || !previewEl) {
        return;
      }

      inputEl.addEventListener('change', function () {
        const file = inputEl.files && inputEl.files[0] ? inputEl.files[0] : null;

        if (!file) {
          return;
        }

        // শুধু ইমেজ ভ্যালিডেশন
        if (!file.type || !file.type.match(/^image\//)) {
          if (window.toastr) {
            toastr.error('শুধু ইমেজ ফাইল আপলোড করা যাবে।', 'Invalid File');
          } else {
            alert('শুধু ইমেজ ফাইল আপলোড করা যাবে।');
          }
          inputEl.value = '';
          return;
        }

        // ***** Preview দেখানো *****
        const reader = new FileReader();
        reader.onload = function (e) {
          previewEl.src = e.target.result;
        };
        reader.readAsDataURL(file);

        // ***** AJAX Upload (fetch + FormData) *****
        const formData = new FormData();
        formData.append(item.fieldName, file);
        formData.append('type', item.type); // চাইলে backend এ ব্যবহার করতে পারেন

        if (window.toastr) {
          toastr.info(
            (item.type === 'logo' ? 'লোগো' : 'ফেভিকন') + ' আপলোড হচ্ছে, একটু অপেক্ষা করুন...',
            'Uploading'
          );
        }

        fetch(uploadUrl, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken,
                     
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: formData
        })
          .then(function (response) {
            if (!response.ok) {
              // non-2xx হলে error throw করব
              return response.json().then(function (data) {
                const error = new Error('Upload failed');
                error.responseData = data;
                throw error;
              }).catch(function () {
                // JSON parse fail হলেও যেন কিছু হয়
                throw new Error('Upload failed');
              });
            }
            return response.json();
          })
          .then(function (data) {
            if (window.toastr) {
              toastr.clear();
              toastr.success(
                data.message ||
                  (item.type === 'logo'
                    ? 'লোগো সফলভাবে আপলোড হয়েছে।'
                    : 'ফেভিকন সফলভাবে আপলোড হয়েছে।'),
                'Success'
              );
            }

            // ইনপুট রিসেট
            inputEl.value = '';

            // চাইলে reload
            setTimeout(function () {
              window.location.reload();
            }, 800);
          })
          .catch(function (error) {
            if (window.toastr) {
              toastr.clear();

              var msg = 'কোনো সমস্যা হয়েছে, আবার চেষ্টা করুন।';

              if (error.responseData) {
                var resp = error.responseData;
                if (resp.message) {
                  msg = resp.message;
                }
                if (resp.errors) {
                  // Laravel validation error গুলো থাকলে
                  if (resp.errors[item.fieldName] && resp.errors[item.fieldName][0]) {
                    msg = resp.errors[item.fieldName][0];
                  }
                }
              }

              toastr.error(msg, 'Error');
            } else {
              alert('কোনো সমস্যা হয়েছে, আবার চেষ্টা করুন।');
            }

            inputEl.value = '';
          });
      });
    });
  });
</script>
