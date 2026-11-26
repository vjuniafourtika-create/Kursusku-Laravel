
@extends('layouts.app')

@section('title', 'Reset Password - KursusKu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="card-header text-white text-center py-4"
                     style="background: linear-gradient(135deg, #2563eb, #60a5fa);">
                    <h3 class="fw-bold mb-1">🔐 Reset Password</h3>
                    <p class="mb-0">Buat password baru akun KursusKu</p>
                </div>

                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control rounded-3"
                                   value="{{ old('email', $email) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                Password Baru
                            </label>

                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control rounded-3"
                                   placeholder="Minimal 8 karakter"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation"
                                   class="form-label fw-semibold">
                                Konfirmasi Password Baru
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   class="form-control rounded-3"
                                   placeholder="Masukkan ulang password"
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100 rounded-3 py-2 fw-semibold">
                            Simpan Password Baru
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}"
                           class="text-decoration-none">
                            ← Kembali ke Login
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
