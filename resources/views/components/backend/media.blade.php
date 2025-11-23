<!-- Ads Upload -->
<section id="view-media" class="view d-none">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Ad Upload</h5>
            <small class="text-muted">প্রতিটি ব্লকে আলাদা আলাদা অ্যাড ইমেজ দিন</small>
        </div>

        <div class="card-body">
            <!-- You can wrap this in a <form> if needed -->
            <form id="adUploadForm" action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="position_key" value="home_sidebar">

                <div class="row g-3">

                    <!-- Ad Block 1 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="mb-2">Ad Block 1</h6>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Image</label>
                                <input type="file" name="ads[1][image]" class="form-control ad-image-input"
                                    accept="image/*">
                            </div>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Link (optional)</label>
                                <input type="text" name="ads[1][url]" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                            <div class="ad-preview-wrapper border rounded d-flex align-items-center justify-content-center"
                                style="min-height: 120px; overflow: hidden;">
                                @if (ad1('home_sidebar'))
                                    <img src="{{ asset('storage') . '/' . ad1('home_sidebar')->image }}" style="height: 200px;" alt="Ad Preview"
                                        class="img-fluid ad-preview-img">
                                @else
                                 <img src="" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                   <span class="text-muted small ad-preview-placeholder">কোনো ইমেজ সিলেক্ট করা হয়নি</span>
                                @endif

                               
                            </div>
                        </div>
                    </div>

                    <!-- Ad Block 2 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="mb-2">Ad Block 2</h6>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Image</label>
                                <input type="file" name="ads[2][image]" class="form-control ad-image-input"
                                    accept="image/*">
                            </div>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Link (optional)</label>
                                <input type="text" name="ads[2][url]" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                            <div class="ad-preview-wrapper border rounded d-flex align-items-center justify-content-center"
                                style="min-height: 120px; overflow: hidden;">
                                @if (ad2('home_sidebar'))
                                    <img src="{{ asset('storage') . '/' . ad2('home_sidebar')->image }}" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                @else
                                 <img src="" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                   <span class="text-muted small ad-preview-placeholder">কোনো ইমেজ সিলেক্ট করা হয়নি</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Ad Block 3 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="mb-2">Ad Block 3</h6>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Image</label>
                                <input type="file" name="ads[3][image]" class="form-control ad-image-input"
                                    accept="image/*">
                            </div>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Link (optional)</label>
                                <input type="text" name="ads[3][url]" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                            <div class="ad-preview-wrapper border rounded d-flex align-items-center justify-content-center"
                                style="min-height: 120px; overflow: hidden;">
                                @if (ad3('home_sidebar'))
                                    <img src="{{ asset('storage') . '/' . ad3('home_sidebar')->image }}" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                @else
                                 <img src="" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                   <span class="text-muted small ad-preview-placeholder">কোনো ইমেজ সিলেক্ট করা হয়নি</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Ad Block 4 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="mb-2">Ad Block 4</h6>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Image</label>
                                <input type="file" name="ads[4][image]" class="form-control ad-image-input"
                                    accept="image/*">
                            </div>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Link (optional)</label>
                                <input type="text" name="ads[4][url]" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                            <div class="ad-preview-wrapper border rounded d-flex align-items-center justify-content-center"
                                style="min-height: 120px; overflow: hidden;">
                                @if (ad4('home_sidebar'))
                                    <img src="{{ asset('storage') . '/' . ad4('home_sidebar')->image }}" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                @else
                                 <img src="" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                   <span class="text-muted small ad-preview-placeholder">কোনো ইমেজ সিলেক্ট করা হয়নি</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Ad Block 5 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="mb-2">Ad Block 5</h6>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Image</label>
                                <input type="file" name="ads[5][image]" class="form-control ad-image-input"
                                    accept="image/*">
                            </div>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Link (optional)</label>
                                <input type="text" name="ads[5][url]" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                            <div class="ad-preview-wrapper border rounded d-flex align-items-center justify-content-center"
                                style="min-height: 120px; overflow: hidden;">
                                @if (ad5('home_sidebar'))
                                    <img src="{{ asset('storage') . '/' . ad5('home_sidebar')->image }}" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                @else
                                 <img src="{{ asset('storage') . '/' . ad4('home_sidebar')->image }}" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                   <span class="text-muted small ad-preview-placeholder">কোনো ইমেজ সিলেক্ট করা হয়নি</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Ad block 6-->
                    <div class="col-md-4 col-sm-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="mb-2">Ad Block 6</h6>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Image</label>
                                <input type="file" name="ads[6][image]" class="form-control ad-image-input"
                                    accept="image/*">
                            </div>

                            <div class="mb-2">
                                <label class="form-label small mb-1">Ad Link (optional)</label>
                                <input type="text" name="ads[6][url]" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                            <div class="ad-preview-wrapper border rounded d-flex align-items-center justify-content-center"
                                style="min-height: 120px; overflow: hidden;">
                                @if (ad6('home_sidebar'))
                                    <img src="{{ asset('storage') . '/' . ad6
                                    ('home_sidebar')->image }}" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                @else
                                 <img src="" alt="Ad Preview"
                                        class="img-fluid ad-preview-img" style="height: 200px;">
                                   <span class="text-muted small ad-preview-placeholder">কোনো ইমেজ সিলেক্ট করা হয়নি</span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Submit button example -->

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Ads
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.ad-image-input').forEach(function(input) {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const block = e.target.closest('.border');
                const wrapper = block.querySelector('.ad-preview-wrapper');
                const img = wrapper.querySelector('.ad-preview-img');
                const placeholder = wrapper.querySelector('.ad-preview-placeholder');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        img.src = ev.target.result;
                        img.classList.remove('d-none');
                        placeholder.classList.add('d-none');
                    };
                    reader.readAsDataURL(file);
                } else {
                    img.src = '#';
                    img.classList.add('d-none');
                    placeholder.classList.remove('d-none');
                }
            });
        });
    });
</script>
