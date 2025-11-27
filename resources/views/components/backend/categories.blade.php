<!-- Categories -->
<section id="view-categories" class="view ">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">ক্যাটাগরি</h5>
            <button
                class="btn btn-primary"
                id="btnCreateCategory"
                data-bs-toggle="modal"
                data-bs-target="#categoryModal"
            >
                <i class="bi bi-plus-lg"></i> নতুন ক্যাটাগরি
            </button>
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
                    <?php $counter = 1; ?>
                    @forelse ($categories as $category)
                        <tr data-row-id="{{ $category->id }}">
                            <td>{{ $counter }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->type }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    {{-- EDIT BUTTON --}}
                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary btn-edit-category"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-slug="{{ $category->slug }}"
                                        data-type="{{ $category->type }}"
                                        data-order="{{ $category->order_column ?? 0 }}"
                                        data-active="{{ $category->is_active ?? 1 }}"
                                        data-update-url="{{ route('categories.update', $category) }}"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    {{-- DELETE BUTTON --}}
                                    <button
                                        type="button"
                                        class="btn btn-outline-danger btn-delete-category"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-delete-url="{{ route('categories.destroy', $category) }}"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                কোনো ক্যাটাগরি পাওয়া যায়নি
                            </td>
                        </tr>
                    @endforelse
                   
                </tbody>
            </table>

            {{-- পেজিনেশন থাকলে --}}
            {{ $categories->links() }}
        </div>
    </div>
</section>

{{-- CREATE / EDIT MODAL --}}
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="categoryForm">
                @csrf
                <input type="hidden" name="category_id" id="category_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalTitle">নতুন ক্যাটাগরি</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-12">
                        <label class="form-label">নাম</label>
                        <input class="form-control" name="name" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">স্লাগ</label>
                        <input class="form-control" name="slug" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">টাইপ</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Select type</option>
                            <option value="news">News</option>
                            <option value="photos">Photos</option>
                            <option value="videos">Videos</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">ক্রম</label>
                        <input class="form-control" name="order_column" type="number" value="0">
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <div class="form-check mt-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                id="is_active"
                                checked
                            >
                            <label class="form-check-label" for="is_active">
                                সক্রিয়
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">ক্যানসেল</button>
                    <button class="btn btn-primary" type="submit" id="categorySubmitBtn">
                        <i class="bi bi-save"></i> সেভ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form         = document.getElementById('categoryForm');
    const modalEl      = document.getElementById('categoryModal');
    const modalTitleEl = document.getElementById('categoryModalTitle');
    const submitBtn    = document.getElementById('categorySubmitBtn');
    const createBtn    = document.getElementById('btnCreateCategory');
    const csrfMeta     = document.querySelector('meta[name="csrf-token"]');

    if (!form || !csrfMeta) return;

    const csrfToken    = csrfMeta.getAttribute('content');
    const storeUrl     = "{{ route('categories.store') }}";

    let isSubmitting     = false;
    let isEditMode       = false;
    let currentUpdateUrl = null;

    // 🔁 helper: create মোডে form reset
    const resetFormToCreate = () => {
        form.reset();
        isEditMode       = false;
        currentUpdateUrl = null;
        document.getElementById('category_id').value = '';
        const activeInput = form.querySelector('input[name="is_active"]');
        if (activeInput) activeInput.checked = true;
        modalTitleEl.textContent = 'নতুন ক্যাটাগরি';
        submitBtn.innerHTML      = '<i class="bi bi-save"></i> সেভ';
    };

    // ➕ নতুন ক্যাটাগরি
    if (createBtn) {
        createBtn.addEventListener('click', function() {
            resetFormToCreate();
            // modal খুলবে ইতিমধ্যেই data-bs-target দিয়ে
        });
    }

    // ✏️ EDIT বাটন – modal pre-fill + update mode
    document.querySelectorAll('.btn-edit-category').forEach(btn => {
        btn.addEventListener('click', function() {
            const id     = this.dataset.id;
            const name   = this.dataset.name;
            const slug   = this.dataset.slug;
            const type   = this.dataset.type;
            const order  = this.dataset.order || 0;
            const active = this.dataset.active === '0' ? 0 : 1;
            const url    = this.dataset.updateUrl;

            isEditMode       = true;
            currentUpdateUrl = url;

            modalTitleEl.textContent = 'ক্যাটাগরি এডিট করুন';
            submitBtn.innerHTML      = '<i class="bi bi-save"></i> আপডেট';

            form.querySelector('input[name="name"]').value         = name;
            form.querySelector('input[name="slug"]').value         = slug;
            form.querySelector('select[name="type"]').value        = type ?? '';
            form.querySelector('input[name="order_column"]').value = order;
            document.getElementById('category_id').value           = id;

            const activeInput = form.querySelector('input[name="is_active"]');
            if (activeInput) activeInput.checked = (active == 1);

            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        });
    });

    // 🗑 DELETE বাটন – JSON destroy
    document.querySelectorAll('.btn-delete-category').forEach(btn => {
        btn.addEventListener('click', function() {
            const id   = this.dataset.id;
            const name = this.dataset.name;
            const url  = this.dataset.deleteUrl;

            if (!confirm(`'${name}' ক্যাটাগরিটি মুছে ফেলতে চান?`)) {
                return;
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ _method: 'DELETE' }),
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    toastr.success('ক্যাটাগরি মুছে ফেলা হয়েছে।');
                    const row = document.querySelector(`tr[data-row-id="${id}"]`);
                    if (row) row.remove();
                } else {
                    toastr.error('মুছতে সমস্যা হয়েছে।');
                    console.error('Delete error:', data);
                }
            })
            .catch(err => {
                console.error(err);
                toastr.error('সার্ভারের সাথে কানেক্ট করা যাচ্ছে না।');
            });
        });
    });

    // 💾 CREATE / UPDATE submit
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        if (isSubmitting) return;

        const activeInput = form.querySelector('input[name="is_active"]');

        isSubmitting = true;
        let originalBtnHtml = submitBtn.innerHTML;
        submitBtn.disabled  = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            সেভ হচ্ছে...
        `;

        const formData = new FormData(form);

        // checkbox → 1/0
        const isActive = activeInput && activeInput.checked ? 1 : 0;
        formData.set('is_active', isActive);

        let url    = storeUrl;
        let method = 'POST';

        if (isEditMode && currentUpdateUrl) {
            url = currentUpdateUrl;
            formData.set('_method', 'PUT'); // Laravel method spoof
        }

        // debug payload
        const payload = {};
        formData.forEach((v, k) => payload[k] = v);
        console.log('Submitting category payload:', payload);

        try {
            const response = await fetch(url, {
                method: method,
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
                const msg = isEditMode ? 'ক্যাটাগরি সফলভাবে আপডেট হয়েছে।' : 'ক্যাটাগরি সফলভাবে সেভ হয়েছে।';
                toastr.success(msg);

                // form reset + modal close
                resetFormToCreate();
                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                modal.hide();

                // সহজ উপায়: reload করে fresh data
                window.location.reload();
            } else {
                console.error('Error response:', data);
                let message = 'সেভ করতে সমস্যা হয়েছে। আবার চেষ্টা করুন।';
                if (data && data.message) {
                    message = data.message;
                }
                if (data && data.errors) {
                    message = 'ডাটা ঠিকভাবে পূরণ করুন (Validation error)।';
                    console.log('Validation errors:', data.errors);
                }
                toastr.error(message);
            }
        } catch (error) {
            console.error('Request failed:', error);
            toastr.error('সার্ভারের সাথে কানেক্ট করা যাচ্ছে না। একটু পরে চেষ্টা করুন।');
        } finally {
            isSubmitting        = false;
            submitBtn.disabled  = false;
            submitBtn.innerHTML = originalBtnHtml;
        }
    });
});
</script>
@endpush
