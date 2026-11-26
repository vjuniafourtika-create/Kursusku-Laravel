
@extends('layouts.app')

@section('title', 'Login - KursusKu')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center align-items-center">

        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER LOGIN --}}
                <div class="text-center text-white p-4"
                     style="background: linear-gradient(135deg, #164B8C, #287BC1);">

                    <div class="mb-3" style="font-size: 48px;">
                        📘
                    </div>

                    <h2 class="fw-bold mb-2">
                        Selamat Datang!
                    </h2>

                    <p class="mb-0">
                        Masuk ke akun KursusKu kamu
                    </p>

                </div>

                {{-- FORM LOGIN --}}
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">

                        <h4 class="fw-bold" style="color: #164B8C;">
                            Login Akun
                        </h4>

                        <p class="text-muted">
                            Silakan masukkan email dan password.
                        </p>

                    </div>

                    {{-- Pesan Kesalahan --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form action="{{ route('login.store') }}" method="POST">

                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-3">

                            <label for="email" class="form-label fw-semibold">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control form-control-lg rounded-3"
                                placeholder="Masukkan email"
                                value="{{ old('email') }}"
                                autocomplete="username"
                                required
                                autofocus
                            >

                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">

                            <label for="password" class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-group">

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control form-control-lg"
                                    placeholder="Masukkan password"
                                    autocomplete="current-password"
                                    required
                                >

                                <button
                                    class="btn btn-outline-secondary"
                                    type="button"
                                    id="togglePassword"
                                    aria-label="Tampilkan password"
                                >
                                    <span id="eyeIcon">👁️</span>
                                </button>

                            </div>

                        </div>

                        {{-- REMEMBER ME --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="remember"
                                    name="remember"
                                    value="1"
                                >

                                <label class="form-check-label"
                                       for="remember">
                                    Remember Me
                                </label>

                            </div>

                            <a href="{{ route('password.request') }}"
                               class="text-decoration-none fw-semibold"
                               style="color: #287BC1;">
                                Forgot Password?
                            </a>

                        </div>

                        {{-- TOMBOL LOGIN --}}
                        <button
                            type="submit"
                            class="btn btn-primary btn-lg w-100 rounded-3 fw-bold"
                            style="background: #164B8C; border: none;"
                        >
                            Login Sekarang
                        </button>

                    </form>

                    {{-- KEMBALI KE BERANDA --}}
                    <div class="text-center mt-4">

                        <a href="{{ route('home') }}"
                           class="text-decoration-none text-muted">
                            ← Kembali ke Beranda
                        </a>

                    </div>

                </div>

            </div>

            <p class="text-center text-muted mt-4 small">
                © {{ date('Y') }} KursusKu. Belajar Bersama, Berkembang Bersama.
            </p>

        </div>

    </div>

</div>

{{-- SCRIPT SHOW / HIDE PASSWORD --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const password = document.getElementById('password');
        const toggle = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        toggle.addEventListener('click', function () {

            if (password.type === 'password') {

                password.type = 'text';
                eyeIcon.textContent = '🙈';
                toggle.setAttribute('aria-label', 'Sembunyikan password');

            } else {

                password.type = 'password';
                eyeIcon.textContent = '👁️';
                toggle.setAttribute('aria-label', 'Tampilkan password');

            }

        });

    });
</script>

@endsection
