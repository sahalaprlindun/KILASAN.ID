@extends('layouts.app')

@section('title', 'Login Admin')

@push('head')
<style>
    main { min-height: calc(100vh - 120px); background: linear-gradient(135deg, #005B9F 0%, #28A47B 100%); display: flex; align-items: center; }
    .main-header, .footer { display: none; }
    .login-card {
        background: rgba(255, 255, 255, .15);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, .3);
        border-radius: 48px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, .28);
        color: white;
    }
    .login-card .form-control {
        background: rgba(255, 255, 255, .2);
        border: 1px solid rgba(255, 255, 255, .4);
        border-radius: 60px;
        color: white;
    }
    .login-card .form-control::placeholder { color: rgba(255,255,255,.75); }
    .login-card .form-control:focus { background: rgba(255,255,255,.28); color: white; border-color: white; box-shadow: none; }
    .login-card .btn-primary { background: #28A47B; border: 1px solid rgba(255,255,255,.55); border-radius: 60px; }

    /* Password toggle style */
    .password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .password-wrapper .form-control {
        padding-right: 3rem;
    }
    .toggle-password {
        position: absolute;
        right: 1rem;
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.8);
        transition: color 0.2s;
        z-index: 2;
    }
    .toggle-password:hover {
        color: white;
    }
    .toggle-password:focus {
        outline: none;
    }
    .eye-icon {
        width: 1.4rem;
        height: 1.4rem;
        display: block;
        pointer-events: none;
    }
</style>
@endpush

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-card p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="fs-2 fw-bold" style="background:linear-gradient(135deg,#ffffff,#c7e0ff); -webkit-background-clip:text; background-clip:text; color:transparent;">KILASAN.id</div>
                    <p class="mb-0">Kita Lapor Kekerasan</p>
                    <hr class="w-50 mx-auto" style="background:rgba(255,255,255,.35);">
                </div>
                <h5 class="text-center mb-3">Masuk ke Panel Admin</h5>
                <form method="post" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input class="form-control" type="password" name="password" id="password-field" required>
                            <button type="button" class="toggle-password" id="togglePasswordBtn" aria-label="Tampilkan password">
                                <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <button class="btn btn-primary w-100 py-2">Sign In</button>
                </form>
                <div class="small mt-3" style="color:#d9ecff;">
                    Akun awal: <strong>superadmin / super123</strong> atau <strong>admin / admin123</strong>.
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        const passwordInput = document.getElementById('password-field');
        const toggleBtn = document.getElementById('togglePasswordBtn');
        if (!passwordInput || !toggleBtn) return;

        // Simpan SVG asli (mata terbuka)
        const openEyeSVG = '<svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>';
        // SVG mata tertutup (garis coret)
        const closedEyeSVG = '<svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>';

        let isPasswordVisible = false;

        function updateToggle() {
            if (isPasswordVisible) {
                passwordInput.type = 'text';
                toggleBtn.innerHTML = closedEyeSVG;
                toggleBtn.setAttribute('aria-label', 'Sembunyikan password');
            } else {
                passwordInput.type = 'password';
                toggleBtn.innerHTML = openEyeSVG;
                toggleBtn.setAttribute('aria-label', 'Tampilkan password');
            }
        }

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            isPasswordVisible = !isPasswordVisible;
            updateToggle();
        });
    })();
</script>
@endsection