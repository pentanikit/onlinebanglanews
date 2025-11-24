        <!-- Posts -->
        <section id="view-posts" class="view d-none">
            <div class="card">
                <div class="card-header">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h5 class="mb-0">পোস্ট ম্যানেজ</h5>
                        </div>
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
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal"><i
                                    class="bi bi-plus-lg"></i> নতুন পোস্ট</button>
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
                        <tbody id="postsTbody">
                            @forelse ($posts as $item)
                            <tr>
                                <td><img style="width: 100px; height:100px;" src="{{ asset('storage').'/'.$item->featuredImage->file_path ?? '' }}" alt="" srcset=""> {{ $item->title }}</td>
                                <td>{{ $item->category->name ?? 'Null' }}</td>
                                <td>{{ $item->tags[0]->name ?? 'Null' }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->created_at }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    {{-- Edit button --}}
                                    <a href="{{ route('posts.edit', $item->id) }}" 
                                    class="btn btn-sm btn-outline-primary" 
                                    title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete form --}}
                                    <form action="{{ route('posts.destroy', $item->id) }}" 
                                        method="POST"
                                        onsubmit="return confirm('আপনি কি নিশ্চিত এই পোস্টটি ডিলিট করতে চান?');"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                            </tr>

                            @empty
                             <tr>
                                <td>No items found</td>
                             </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between small text-secondary">
                    <div id="postsSummary">{{ $posts->count() }} ফলাফল</div>
                    <div class="btn-group">
                        {{-- <button class="btn btn-outline-secondary" id="prevPage">পূর্ববর্তী</button>
                        <button class="btn btn-outline-secondary" id="nextPage">পরবর্তী</button> --}}
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </section>


        <div class="modal fade" id="postModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content" style="overflow-y: scroll;">
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
                                <select class="form-select" name="category_id" id="postCategory">
                                        <option value="" selected>Choose a category</option>
                                    @forelse ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        <p>No categories found</p>
                                    @endforelse
                                </select>
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
                                <label class="form-label">এক্সসার্প্ট</label>
                                <textarea class="form-control" name="excerpt" rows="2"></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label">কনটেন্ট</label>
                                <textarea class="form-control" name="content" rows="6"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">ট্যাগ</label>

                                <!-- ট্যাগ বক্স -->
                                <div id="tagBox" class="form-control d-flex flex-wrap align-items-center gap-2"
                                    style="min-height: 46px;">
                                    <!-- এখানে ট্যাগগুলো আসবে -->
                                    <input type="text" id="tagInput" class="border-0 flex-grow-1"
                                        style="outline: none; min-width: 120px;" 
                                        placeholder="ট্যাগ লিখে Enter বা Space চাপুন">
                                </div>

                                <!-- এখানে কমা-সেপারেটেড ট্যাগ গুলো যাবে (form submit হবে এই ফিল্ড দিয়ে) -->
                                <textarea class="form-control d-none" name="tags" id="tagStorage" rows="2"></textarea>
                            </div>


                            <!-- Multi-image upload -->
                            <div class="col-12">
                                <label class="form-label">
                                    ইমেজ (একাধিক নির্বাচন করা যাবে না)
                                </label>
                                <input class="form-control" type="file" name="image" id="postImages"
                                    accept="image/*" required>
                                <small class="text-muted d-block mt-1">
                                     ইমেজ প্রিভিউ।
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






      {{-- tag input style --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tagBox = document.getElementById('tagBox');
                const tagInput = document.getElementById('tagInput');
                const tagStorage = document.getElementById('tagStorage');

                const tags = [];

                function renderTags() {
                    // আগের সব ট্যাগ pill রিমুভ করি (input বাদে)
                    tagBox.querySelectorAll('.tag-pill').forEach(el => el.remove());

                    tags.forEach((tag, index) => {
                        const pill = document.createElement('span');
                        pill.className =
                            'tag-pill badge bg-secondary me-1 mb-1 d-inline-flex align-items-center';

                        pill.innerHTML = `
                  <span class="me-1">${tag}</span>
                  <button type="button" class="btn-close btn-close-white btn-sm ms-1" aria-label="Remove"></button>
              `;

                        // রিমুভ বাটন ক্লিক
                        pill.querySelector('button').addEventListener('click', function() {
                            removeTag(index);
                        });

                        // input এর আগে ইনসার্ট করি
                        tagBox.insertBefore(pill, tagInput);
                    });

                    // hidden textarea তে কমা দিয়ে সব ট্যাগ সেভ
                    tagStorage.value = tags.join(',');
                }

                function addTag(text) {
                    const value = text.trim();
                    if (!value) return;

                    // ডুপ্লিকেট ট্যাগ না নেওয়া চাইলে
                    if (tags.includes(value)) {
                        tagInput.value = '';
                        return;
                    }

                    tags.push(value);
                    tagInput.value = '';
                    renderTags();
                }

                function removeTag(index) {
                    tags.splice(index, 1);
                    renderTags();
                }

                // Enter বা Space চাপলে ট্যাগ বানাবে
                tagInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        addTag(tagInput.value);
                    } else if (e.key === 'Backspace' && !tagInput.value && tags.length) {
                        // ইনপুট খালি থাকলে Backspace চাপে শেষ ট্যাগ ডিলিট করবে
                        tags.pop();
                        renderTags();
                    }
                });
            });
        </script>


        {{-- send post ajax request --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('postForm');
                const imageInput = document.getElementById('postImages');
                const previewWrap = document.getElementById('postImagePreview');
                if (!form) return;

                // ---------- Image preview ----------
                if (imageInput && previewWrap) {
                    imageInput.addEventListener('change', function() {
                        previewWrap.innerHTML = '';

                        const files = Array.from(this.files || []);
                        if (!files.length) return;

                        files.forEach((file, index) => {
                            if (!file.type.startsWith('image/')) return;

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const wrapper = document.createElement('div');
                                wrapper.className =
                                    'position-relative border rounded overflow-hidden';
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
                                badge.className =
                                    'badge bg-dark position-absolute top-0 start-0 m-1';
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

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    if (isSubmitting) {
                        console.log('Already submitting… double submit prevented.');
                        return;
                    }

                    const submitBtn = form.querySelector('button[type="submit"]');
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
                                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(
                                    modalEl);
                                modal.hide();
                            }
                            // window.location.reload();
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