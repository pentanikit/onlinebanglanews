        <!-- Posts -->
        <section id="view-posts" class="view d-none">
          <div class="card">
            <div class="card-header">
              <div class="row g-2 align-items-center">
                <div class="col"><h5 class="mb-0">পোস্ট ম্যানেজ</h5></div>
                <div class="col-12 col-md-auto">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input id="postSearch" class="form-control" placeholder="শিরোনাম/ট্যাগ">
                  </div>
                </div>
                <div class="col-6 col-md-auto">
                  <select id="postStatus" class="form-select">
                    <option value="">সব স্ট্যাটাস</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="pending">Pending</option>
                  </select>
                </div>
                <div class="col-6 col-md-auto text-end">
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal"><i class="bi bi-plus-lg"></i> নতুন পোস্ট</button>
                </div>
              </div>
            </div>
            <div class="card-body card-table">
              <table class="table table-striped align-middle">
                <thead>
                  <tr>
                    <th>শিরোনাম</th>
                    <th>ক্যাটাগরি</th>
                    <th>ট্যাগ</th>
                    <th>স্ট্যাটাস</th>
                    <th>তারিখ</th>
                    <th class="text-end">একশন</th>
                  </tr>
                </thead>
                <tbody id="postsTbody"></tbody>
              </table>
            </div>
            <div class="card-footer d-flex justify-content-between small text-secondary">
              <div id="postsSummary">0 ফলাফল</div>
              <div class="btn-group">
                <button class="btn btn-outline-secondary" id="prevPage">পূর্ববর্তী</button>
                <button class="btn btn-outline-secondary" id="nextPage">পরবর্তী</button>
              </div>
            </div>
          </div>
        </section>


 <div class="modal fade" id="postModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form id="postForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">নতুন পোস্ট</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-12">
            <label class="form-label">শিরোনাম</label>
            <input class="form-control" name="title" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">ক্যাটাগরি</label>
            <select class="form-select" name="category_id" id="postCategory"></select>
          </div>

          <div class="col-md-6">
            <label class="form-label">স্ট্যাটাস</label>
            <select class="form-select" name="status" required>
              <option value="draft">Draft</option>
              <option value="pending">Pending</option>
              <option value="published">Published</option>
            </select>
          </div>

          <div class="col-12">
            <label class="form-label">সাবহেড/ইনট্রো</label>
            <input class="form-control" name="subheading">
          </div>

          <div class="col-12">
            <label class="form-label">এক্সসার্প্ট</label>
            <textarea class="form-control" name="excerpt" rows="2"></textarea>
          </div>

          <div class="col-12">
            <label class="form-label">কনটেন্ট</label>
            <textarea class="form-control" name="content" rows="6"></textarea>
          </div>

          <!-- Multi-image upload -->
          <div class="col-12">
            <label class="form-label">
              ইমেজ (একাধিক নির্বাচন করা যাবে)
            </label>
            <input
              class="form-control"
              type="file"
              name="image"
              id="postImages"
              
              accept="image/*"
            >
            <small class="text-muted d-block mt-1">
              এক বা একাধিক ইমেজ সিলেক্ট করলে নিচে প্রিভিউ দেখা যাবে।
            </small>

            <!-- Preview area -->
            <div class="mt-2 d-flex flex-wrap gap-2" id="postImagePreview"></div>
          </div>

          <div class="col-md-6 form-check ms-2">
            <input class="form-check-input" type="checkbox" name="is_breaking" id="isBreaking">
            <label class="form-check-label" for="isBreaking">ব্রেকিং</label>
          </div>

          <div class="col-md-6 form-check ms-2">
            <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured">
            <label class="form-check-label" for="isFeatured">ফিচার্ড</label>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">ক্যানসেল</button>
          <button class="btn btn-primary" type="submit">
            <i class="bi bi-save"></i> সেভ
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


{{-- image preview --}}



{{-- send post ajax request --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form        = document.getElementById('postForm');
    const imageInput  = document.getElementById('postImages');
    const previewWrap = document.getElementById('postImagePreview');
    if (!form) return;

    // ---------- Image preview ----------
    if (imageInput && previewWrap) {
      imageInput.addEventListener('change', function () {
        previewWrap.innerHTML = '';

        const files = Array.from(this.files || []);
        if (!files.length) return;

        files.forEach((file, index) => {
          if (!file.type.startsWith('image/')) return;

          const reader = new FileReader();
          reader.onload = function (e) {
            const wrapper = document.createElement('div');
            wrapper.className = 'position-relative border rounded overflow-hidden';
            wrapper.style.width = '90px';
            wrapper.style.height = '90px';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = file.name;
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';

            const badge = document.createElement('span');
            badge.textContent = index + 1;
            badge.className = 'badge bg-dark position-absolute top-0 start-0 m-1';
            badge.style.opacity = '0.8';

            wrapper.appendChild(img);
            wrapper.appendChild(badge);
            previewWrap.appendChild(wrapper);
          };
          reader.readAsDataURL(file);
        });
      });
    }

    // ---------- AJAX submit ----------
    let isSubmitting = false;

    form.addEventListener('submit', async function (e) {
      e.preventDefault();
      if (isSubmitting) {
        console.log('Already submitting… double submit prevented.');
        return;
      }

      const submitBtn   = form.querySelector('button[type="submit"]');
      const breakingChk = form.querySelector('input[name="is_breaking"]');
      const featuredChk = form.querySelector('input[name="is_featured"]');

      // Loading state ON
      isSubmitting = true;
      let originalBtnHtml = '';
      if (submitBtn) {
        originalBtnHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
          <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
          সেভ হচ্ছে...
        `;
      }

      const formData = new FormData(form);

      // Normalize checkboxes to 1/0
      formData.set('is_breaking', breakingChk && breakingChk.checked ? 1 : 0);
      formData.set('is_featured', featuredChk && featuredChk.checked ? 1 : 0);

      // Console payload (text + basic file info)
      const debugPayload = {};
      formData.forEach((value, key) => {
        if (value instanceof File) {
          if (!debugPayload[key]) debugPayload[key] = [];
          debugPayload[key].push({
            name: value.name,
            size: value.size,
            type: value.type
          });
        } else {
          debugPayload[key] = value;
        }
      });
      console.log('Submitting post payload:', debugPayload);

      const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');

      try {
        const response = await fetch("{{ route('posts.store') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: formData
        });

        let data = null;
        try {
          data = await response.json();
        } catch (e) {
          console.warn('Response is not valid JSON', e);
        }

        if (response.ok && data && (data.success ?? true)) {
          // ✅ SUCCESS
          toastr.success('পোস্ট সফলভাবে সেভ হয়েছে।');

          // চাইলে এখানে product/post table refresh করতে পারো
          // await refreshPostsTable();

          // Reset form + preview
          form.reset();
          if (breakingChk) breakingChk.checked = false;
          if (featuredChk) featuredChk.checked = false;
          if (previewWrap) previewWrap.innerHTML = '';

          // Close modal
          const modalEl = document.getElementById('postModal');
          if (modalEl) {
            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.hide();
          }
        } else {
          console.error('Error response:', data);

          let message = 'সেভ করতে সমস্যা হয়েছে। আবার চেষ্টা করুন।';
          if (data && data.message) {
            message = data.message;
          }
          if (data && data.errors) {
            const firstField = Object.keys(data.errors)[0];
            if (firstField && data.errors[firstField][0]) {
              message = data.errors[firstField][0];
            }
          }

          toastr.error(message);
        }
      } catch (error) {
        console.error('Request failed:', error);
        toastr.error('সার্ভারের সাথে কানেক্ট করা যাচ্ছে না। একটু পরে চেষ্টা করুন।');
      } finally {
        isSubmitting = false;
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml || '<i class="bi bi-save"></i> সেভ';
        }
      }
    });
  });
</script>
