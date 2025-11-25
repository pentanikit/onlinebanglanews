<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bangla Newspaper Admin</title>
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    @stack('css')
    <style>
        :root {
            color-scheme: light dark;
        }

        body {
            background-color: var(--bs-body-bg);
        }

        .sidebar {
            width: 280px;
        }

        .sidebar .nav-link {
            border-radius: .5rem;
        }

        .sidebar .nav-link.active {
            background: rgba(var(--bs-primary-rgb), .15);
            color: var(--bs-primary);
        }

        .content-wrap {
            min-height: 100dvh;
        }

        .card-table {
            overflow: auto;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: .25rem;
            padding: .1rem .5rem;
            border: 1px solid var(--bs-border-color);
            border-radius: 1rem;
            font-size: .75rem;
        }

        .status-dot {
            width: .5rem;
            height: .5rem;
            border-radius: 50%;
            display: inline-block;
        }

        .status-published {
            background: #22c55e;
        }

        .status-draft {
            background: #64748b;
        }

        .status-pending {
            background: #eab308;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<x-backend.navbar />
<div class="container-fluid">
    <div class="row content-wrap">
       

        <x-backend.sidebar />

        <main class="col-lg-9 col-xl-10 p-3 p-lg-4">

             @yield('content')
            {{-- <x-backend.dashboard />

            <x-backend.logos />
            <!-- Posts -->
            <x-backend.posts />



            <!-- Categories -->
            <x-backend.categories />

            <!-- Tags -->
            <x-backend.tags />

            <!-- Media -->
            <x-backend.media />

            <!-- Menus -->
            <x-backend.menus />

            <!-- Users -->
            <x-backend.users />

            <!-- Comments -->
            <x-backend.comments />

            <!-- Settings -->
            <x-backend.settings /> --}}
        </main>

    </div>
</div>

<!-- Modals: Post / Category / Tag / Page / User -->




<div class="modal fade" id="tagModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="tagForm">
                <div class="modal-header">
                    <h5 class="modal-title">নতুন ট্যাগ</h5><button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-12"><label class="form-label">নাম</label><input class="form-control" name="name"
                            required></div>
                    <div class="col-12"><label class="form-label">স্লাগ</label><input class="form-control"
                            name="slug"></div>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary"
                        data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary" type="submit"><i
                            class="bi bi-save"></i> সেভ</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="pageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="pageForm">
                <div class="modal-header">
                    <h5 class="modal-title">নতুন পেইজ</h5><button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-12"><label class="form-label">শিরোনাম</label><input class="form-control"
                            name="title" required></div>
                    <div class="col-md-6"><label class="form-label">স্লাগ</label><input class="form-control"
                            name="slug"></div>
                    <div class="col-md-6"><label class="form-label">স্ট্যাটাস</label><select class="form-select"
                            name="status">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select></div>
                    <div class="col-12"><label class="form-label">কনটেন্ট</label>
                        <textarea class="form-control" name="content" rows="6"></textarea>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary"
                        data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary" type="submit"><i
                            class="bi bi-save"></i> সেভ</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="userForm">
                <div class="modal-header">
                    <h5 class="modal-title">নতুন ইউজার</h5><button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-12"><label class="form-label">নাম</label><input class="form-control" name="name"
                            required></div>
                    <div class="col-12"><label class="form-label">ইমেইল</label><input class="form-control"
                            name="email" type="email" required></div>
                    <div class="col-12"><label class="form-label">রোল</label><input class="form-control"
                            name="role" placeholder="admin/editor/reporter"></div>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary"
                        data-bs-dismiss="modal">ক্যানসেল</button><button class="btn btn-primary" type="submit"><i
                            class="bi bi-save"></i> সেভ</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
{{-- jQuery (required for toastr) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


{{-- Toastr JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Theme toggle
    (function() {
        const btn = document.getElementById('toggleTheme');
        const key = 'bn-admin-theme';
        const set = (mode) => {
            document.documentElement.setAttribute('data-bs-theme', mode);
            localStorage.setItem(key, mode);
            btn.innerHTML = mode === 'dark' ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon-stars"></i>';
        };
        set(localStorage.getItem(key) || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
            'light'));
        btn.addEventListener('click', () => set((document.documentElement.getAttribute('data-bs-theme') ===
            'dark') ? 'light' : 'dark'));
    })();


</script>
@stack('js')
</body>

</html>
