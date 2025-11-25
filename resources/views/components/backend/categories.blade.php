        <!-- Categories -->
        <section id="view-categories" class="view ">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">ক্যাটাগরি</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal"><i
                            class="bi bi-plus-lg"></i> নতুন ক্যাটাগরি</button>
                </div>
                <div class="card-body card-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ক্রম</th>
                                <th>নাম</th>
                                <th>স্লাগ</th>
                                <th>টাইপ</th>


                                <th>একশন</th>
                            </tr>
                        </thead>
                        <tbody id="categoriesTbody">
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->type }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-secondary"><i
                                                    class="bi bi-pencil"></i></button>
                                            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>No Items Found</tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <div class="modal fade" id="categoryModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="categoryForm">
                        <div class="modal-header">
                            <h5 class="modal-title">নতুন ক্যাটাগরি</h5><button class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-12"><label class="form-label">নাম</label><input class="form-control"
                                    name="name" required></div>
                            <div class="col-12"><label class="form-label">স্লাগ</label><input class="form-control"
                                    name="slug" required></div>
                            <div class="col-md-6"><label class="form-label">টাইপ</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="news">News</option>
                                    <option value="photos">Photos</option>
                                    <option value="videos">Videos</option>
                                </select>
                            </div>
                            <div class="col-md-6"><label class="form-label">ক্রম</label><input class="form-control"
                                    name="order_column" type="number" value="0"></div>

                        </div>
                        <div class="modal-footer"><button class="btn btn-secondary"
                                data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary"
                                type="submit"><i class="bi bi-save"></i> সেভ</button></div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('categoryForm');
                if (!form) return;
                
                let isSubmitting = false; // 🔒 prevent double submit
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    if (isSubmitting) {
                        console.log('Already submitting, ignoring double submit.');
                        return;
                    }

                    const submitBtn = form.querySelector('button[type="submit"]');
                    const activeInput = form.querySelector('input[name="is_active"]');

                    // 🔄 Loading state ON
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

                    // Build FormData
                    const formData = new FormData(form);

                    // Normalize checkbox is_active to 1/0
                    
                    const isActive = activeInput && activeInput.checked ? 1 : 0;
                    formData.set('is_active', isActive);

                    // Build payload object only for logging
                    const payload = {};
                    formData.forEach((value, key) => {
                        payload[key] = value;
                    });

                    console.log('Submitting category payload:', payload);

                    const csrfToken = document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    try {
                        const response = await fetch("{{ route('categories.store') }}", {
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

                        if (response.ok && data && data.success) {
                            // SUCCESS
                            toastr.success('ক্যাটাগরি সফলভাবে সেভ হয়েছে।');

                            // Reset form
                            form.reset();
                            if (activeInput) activeInput.checked = true; // default checked

                            // Close modal
                            const modalEl = document.getElementById('categoryModal');
                            if (modalEl) {
                                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(
                                    modalEl);
                                modal.hide();
                            }

                            window.location.reload(); // পুরো পেজ refresh

                        } else {
                            // ERROR (validation / server)
                            console.error('Error response:', data);

                            let message = 'সেভ করতে সমস্যা হয়েছে। আবার চেষ্টা করুন।';
                            if (data && data.message) {
                                message = data.message;
                            }
                            if (data && data.errors) {
                                message = 'ডাটা ঠিকভাবে পূরণ করুন (Validation error)।';
                            }

                            toastr.error(message);
                        }
                    } catch (error) {
                        console.error('Request failed:', error);
                        toastr.error('সার্ভারের সাথে কানেক্ট করা যাচ্ছে না। একটু পরে চেষ্টা করুন।');
                    }
                });
            });
        </script>
