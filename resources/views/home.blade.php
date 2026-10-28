
@extends('layouts.app')

@section('title', 'Beranda - KursusKu')

@section('content')

<div class="container py-4">

    {{-- Bagian utama Beranda --}}
    <section class="row align-items-center py-5">

        <div class="col-md-6 mb-4">

            <p class="text-primary fw-bold">
                Belajar Web Secara Bertahap
            </p>

            <h1 class="display-5 fw-bold">
                Bangun kemampuan web dari PHP sampai Laravel.
            </h1>

            <p class="lead mt-3">
                KursusKu menyediakan latihan terarah untuk pemula
                agar kamu dapat belajar pemrograman web secara bertahap.
            </p>

            <a href="{{ route('enrollments.create') }}"
               class="btn btn-primary btn-lg mt-2">
                Daftar Sekarang
            </a>

        </div>

        <div class="col-md-6 text-center">

            <img
                src="{{ asset('images/hero-kursus.jpg') }}"
                alt="Ilustrasi kelas KursusKu"
                class="img-fluid rounded shadow"
            >

        </div>

    </section>


    {{-- Katalog kursus lama tetap dipertahankan --}}
    <section class="py-4">

        <div class="text-center mb-4">

            <h2 class="fw-bold">
                Program Belajar Unggulan
            </h2>

            <p class="text-muted">
                Pilih program belajar yang sesuai dengan kebutuhanmu.
            </p>

        </div>

        <div class="row g-4">

            @foreach ($featured as $course)

                <div class="col-md-4">

                    <article class="card h-100 shadow-sm">

                        <div class="card-body">

                            <small class="text-primary fw-bold">
                                {{ $course['code'] }}
                            </small>

                            <h3 class="h5 mt-2">
                                {{ $course['name'] }}
                            </h3>

                            <p class="card-text">
                                {{ $course['description'] }}
                            </p>

                        </div>

                        <div class="card-footer bg-white border-0 pb-3">

                            <a
                                href="{{ route('enrollments.create') }}"
                                class="btn btn-outline-primary"
                            >
                                Daftar Kursus
                            </a>

                        </div>

                    </article>

                </div>

            @endforeach

        </div>

    </section>

</div>

@endsection
