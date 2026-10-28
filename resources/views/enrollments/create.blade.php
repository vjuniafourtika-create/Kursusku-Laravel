
@extends('layouts.app')

@section('title', 'Pendaftaran Kursus - KursusKu')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h1 class="h3 fw-bold mb-2">
                        Formulir Pendaftaran Kursus
                    </h1>

                    <p class="text-muted mb-4">
                        Lengkapi data berikut untuk mendaftar di KursusKu.
                    </p>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Mohon periksa kembali data kamu:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        action="{{ route('enrollments.preview') }}"
                        method="POST"
                    >
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="course_id" class="form-label">
                                Pilih Kursus
                            </label>

                            <select
                                id="course_id"
                                name="course_id"
                                class="form-select"
                                required
                            >
                                <option value="">
                                    -- Pilih kursus --
                                </option>

                                @foreach ($courses as $id => $course)
                                    <option
                                        value="{{ $id }}"
                                        @selected(old('course_id') == $id)
                                    >
                                        {{ $course['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div
                            id="availability"
                            class="alert alert-info d-none"
                            aria-live="polite"
                        ></div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Periksa Pendaftaran
                        </button>

                        <a
                            href="{{ route('home') }}"
                            class="btn btn-outline-secondary w-100 mt-2"
                        >
                            Kembali ke Beranda
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
