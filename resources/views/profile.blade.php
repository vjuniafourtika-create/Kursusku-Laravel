
@extends('layouts.app')

@section('title', 'Profil Pengguna - KursusKu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="text-center text-white py-5"
                     style="background: linear-gradient(135deg, #2563eb, #60a5fa);">

                    <div class="rounded-circle bg-white text-primary d-inline-flex
                                align-items-center justify-content-center mb-3"
                         style="width: 90px; height: 90px; font-size: 40px;">
                        👤
                    </div>

                    <h3 class="fw-bold mb-1">Profil Pengguna</h3>
                    <p class="mb-0">Selamat datang di KursusKu</p>
                </div>

                <div class="card-body p-4">

                    <div class="mb-3">
                        <label class="text-secondary small">Nama Pengguna</label>
                        <h5>{{ auth()->user()->name }}</h5>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="text-secondary small">Email</label>
                        <h5>{{ auth()->user()->email }}</h5>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <label class="text-secondary small">Tanggal Bergabung</label>
                        <h5>{{ auth()->user()->created_at->format('d F Y') }}</h5>
                    </div>

                    <a href="{{ route('home') }}"
                       class="btn btn-primary w-100 rounded-3">
                        Kembali ke Beranda
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
