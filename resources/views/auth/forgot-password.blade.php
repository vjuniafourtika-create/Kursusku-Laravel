
@extends('layouts.app')

@section('title', 'Lupa Password - KursusKu')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="text-center text-white p-4"
                     style="background: linear-gradient(135deg, #164B8C, #287BC1);">

                    <div style="font-size: 48px;">🔐</div>

                    <h2 class="fw-bold mt-2">Lupa Password?</h2>

                    <p class="mb-0">
                        Jangan khawatir, kami bantu kamu.
                    </p>

                </div>

                <div class="card-body p-4 p-md-5">

                    <h4 class="fw-bold text-center"
                        style="color: #164B8C;">
                        Pulihkan Akun
                    </h4>

                    <p class="text-muted text-center mb-4">
                        Masukkan email akunmu untuk menerima tautan
                        pengaturan ulang password.
                    </p>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('password.email') }}"
                          method="POST">

                        @csrf

                        <div class="mb-4">

                            <label for="email" class="form-label fw-semibold">
                                Email Terdaftar
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control form-control-lg rounded-3"
                                placeholder="Masukkan email akun"
                                value="{{ old('email') }}"
                                required
                            >

                        </div>

                        <button type="submit"
                                class="btn btn-primary btn-lg w-100 fw-bold"
                                style="background: #164B8C; border: none;">
                            Kirim Tautan Reset
                        </button>

                    </form>

                    <div class="text-center mt-4">

                        <a href="{{ route('login') }}"
                           class="text-decoration-none"
                           style="color: #287BC1;">
                            ← Kembali ke Login
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
