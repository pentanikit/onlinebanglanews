<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>লগইন | অনলাইন বাংলা পত্রিকা</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Laravel CSRF meta (optional) --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap CSS (যদি layout থেকে লোড করে থাকো, তাহলে এটা বাদ দিতে পারো) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional: Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            background: #f5f5f5;
            font-family: system-ui, -apple-system, "Bangla", "SolaimanLipi", sans-serif;
        }
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            max-width: 420px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }
        .auth-header {
            background: linear-gradient(135deg, #c8102e, #6b0f1a);
            color: #fff;
            padding: 20px 24px;
        }
        .auth-header h1 {
            font-size: 1.4rem;
            margin: 0;
        }
        .auth-header small {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        .auth-logo-circle {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        .auth-body {
            padding: 22px 24px 20px;
            background: #ffffff;
        }
        .auth-footer {
            padding: 12px 24px 18px;
            background: #ffffff;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card bg-white">

        {{-- Header --}}
        <div class="auth-header d-flex align-items-center">
            <div class="auth-logo-circle">
                <i class="fa-solid fa-newspaper fa-lg"></i>
            </div>
            <div>
                <h1>লগইন</h1>
                <small>অনলাইন বাংলা নিউজ পোর্টাল – অ্যাডমিন প্যানেল</small>
            </div>
        </div>

        {{-- Body --}}
        <div class="auth-body">

            {{-- Global success / error messages --}}
            @if(session('success'))
                <div class="alert alert-success py-2">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger py-2">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li style="font-size: 0.86rem;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">ইমেইল ঠিকানা</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="উদাহরণ: editor@example.com"
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-text">
                            অ্যাডমিন হিসেবে নিবন্ধিত ইমেইল ব্যবহার করুন।
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">পাসওয়ার্ড</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                        placeholder="কমপক্ষে 4 অক্ষরের পাসওয়ার্ড"
                    >
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Remember me + Forgot password (optional) --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="remember">
                            আমাকে মনে রাখুন
                        </label>
                    </div>

                    {{-- যদি তোমার কাছে password reset route থাকে --}}
                    {{-- <a href="{{ route('password.request') }}" class="small text-decoration-none">
                        পাসওয়ার্ড ভুলে গেছেন?
                    </a> --}}
                </div>

                {{-- Submit --}}
                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-right-to-bracket me-1"></i>
                        লগইন করুন
                    </button>
                </div>

            </form>
        </div>

        {{-- Footer --}}
        <div class="auth-footer d-flex justify-content-between align-items-center">
            <span class="text-muted">
                &copy; {{ date('Y') }} Online Bangla News
            </span>

            <div class="d-flex gap-2">
                <a href="{{ url('/') }}" class="text-decoration-none small">
                    🏠 হোম পেইজ
                </a>

                {{-- যদি public registration allow করো --}}
                @if(Route::has('register'))
                    <span class="text-muted">|</span>
                    <a href="{{ route('register') }}" class="text-decoration-none small">
                        নতুন অ্যাকাউন্ট
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap JS (layout এ থাকলে বাদ দাও) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
