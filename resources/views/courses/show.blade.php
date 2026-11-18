
@extends('layouts.app')

@section('content')

<style>
    .detail-wrapper {
        background: #f0f7ff;
        min-height: 85vh;
        padding: 35px 15px;
        border-radius: 18px;
    }

    .detail-card {
        background: white;
        border: 1px solid #d9eaff;
        border-radius: 18px;
        box-shadow: 0 5px 20px rgba(70, 130, 190, 0.08);
        overflow: hidden;
    }

    .detail-header {
        background: linear-gradient(135deg, #dceeff, #b9dcff);
        padding: 25px;
        color: #245b91;
    }

    .detail-body {
        padding: 25px;
    }

    .detail-row {
        padding: 14px 0;
        border-bottom: 1px solid #edf3fa;
    }

    .detail-label {
        color: #66819c;
        font-weight: 600;
    }

    .detail-value {
        color: #294d70;
        font-weight: 500;
    }

    .btn-blue {
        background: #5798db;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 10px 20px;
        text-decoration: none;
    }

    .btn-blue:hover {
        background: #367fc9;
        color: white;
    }
</style>

<div class="detail-wrapper">

    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between
                    align-items-center mb-4 flex-wrap gap-2">

            <div>
                <h2 class="fw-bold" style="color:#285f94">
                    Detail Kursus
                </h2>

                <p class="text-muted mb-0">
                    Informasi lengkap kursus KursusKu
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('courses.index') }}"
                   class="btn btn-outline-primary">
                    Kembali
                </a>

                <a href="{{ route('courses.edit', $course) }}"
                   class="btn-blue">
                    Edit Kursus
                </a>
            </div>

        </div>

        <div class="detail-card">

            <div class="detail-header">
                <h4 class="fw-bold mb-1">
                    {{ $course->name }}
                </h4>

                <span>
                    Kode Kursus: {{ $course->code }}
                </span>
            </div>

            <div class="detail-body">

                <div class="row detail-row">
                    <div class="col-md-3 detail-label">
                        Kode Kursus
                    </div>
                    <div class="col-md-9 detail-value">
                        {{ $course->code }}
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-3 detail-label">
                        Nama Kursus
                    </div>
                    <div class="col-md-9 detail-value">
                        {{ $course->name }}
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-3 detail-label">
                        Deskripsi
                    </div>
                    <div class="col-md-9 detail-value">
                        {{ $course->description ?: '-' }}
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-3 detail-label">
                        Biaya
                    </div>
                    <div class="col-md-9 detail-value">
                        Rp {{ number_format($course->fee, 0, ',', '.') }}
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-3 detail-label">
                        Kuota
                    </div>
                    <div class="col-md-9 detail-value">
                        {{ $course->quota }} peserta
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-3 detail-label">
                        Tanggal Mulai
                    </div>
                    <div class="col-md-9 detail-value">
                        {{ $course->start_date?->format('d-m-Y') }}
                    </div>
                </div>

                <div class="row detail-row">
                    <div class="col-md-3 detail-label">
                        Status
                    </div>
                    <div class="col-md-9 detail-value">
                        {{ ucfirst($course->status) }}
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
