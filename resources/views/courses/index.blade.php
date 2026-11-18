
@extends('layouts.app')

@section('content')

<style>
    .course-page {
        min-height: 100vh;
        padding: 45px 20px;
        background: linear-gradient(135deg, #eaf2ff, #f5f8ff);
    }

    .course-container {
        max-width: 1250px;
        margin: auto;
    }

    .course-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 35px rgba(30, 64, 175, 0.12);
        border: 1px solid #e0eaff;
    }

    .course-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 25px;
        padding-bottom: 22px;
        border-bottom: 2px solid #e5edff;
    }

    .heading-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .heading-icon {
        width: 60px;
        height: 60px;
        border-radius: 17px;
        background: linear-gradient(135deg, #2563eb, #60a5fa);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .course-heading h2 {
        color: #173b79;
        font-weight: 700;
        margin: 0;
    }

    .course-heading p {
        color: #718096;
        margin: 5px 0 0;
    }

    .btn-add {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-add:hover {
        background: #1e40af;
        color: white;
        transform: translateY(-2px);
    }

    .table-responsive {
        border-radius: 12px;
        overflow-x: auto;
    }

    .course-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
    }

    .course-table thead th {
        background: #eaf2ff;
        color: #173b79;
        font-weight: 700;
        padding: 16px 14px;
        border-bottom: 2px solid #d5e2f5;
        white-space: nowrap;
    }

    .course-table tbody td {
        padding: 16px 14px;
        color: #334155;
        border-bottom: 1px solid #e8eef8;
        vertical-align: middle;
    }

    .course-table tbody tr:hover {
        background: #f4f8ff;
    }

    .course-code {
        color: #2563eb;
        font-weight: 700;
    }

    .course-name {
        color: #203b68;
        font-weight: 600;
    }

    .course-fee {
        color: #1d4ed8;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-open {
        background: #dcfce7;
        color: #15803d;
    }

    .status-draft {
        background: #fef3c7;
        color: #a16207;
    }

    .status-closed {
        background: #fee2e2;
        color: #b91c1c;
    }

    .empty-data {
        text-align: center;
        padding: 35px !important;
        color: #718096 !important;
    }

    .alert-success {
        border-radius: 10px;
        border: none;
        background: #dcfce7;
        color: #166534;
        padding: 14px 18px;
    }

    .action-buttons {
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
    }

    .btn-detail {
        background: #eaf2ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

    .btn-detail:hover {
        background: #2563eb;
        color: white;
    }

    .btn-edit {
        background: #fff7df;
        color: #a16207;
        border: 1px solid #fde68a;
    }

    .btn-edit:hover {
        background: #f59e0b;
        color: white;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
    }

    .action-buttons .btn {
        border-radius: 7px;
        font-weight: 600;
        font-size: 12px;
    }

    @media (max-width: 600px) {
        .course-card {
            padding: 20px 14px;
        }

        .course-heading {
            align-items: flex-start;
        }

        .btn-add {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="course-page">
    <div class="course-container">

        <div class="course-card">

            <div class="course-heading">

                <div class="heading-title">
                    <div class="heading-icon">
                        <span>▤</span>
                    </div>

                    <div>
                        <h2>Daftar Kursus</h2>
                        <p>Kelola dan lihat seluruh data kursus KursusKu.</p>
                    </div>
                </div>

                <a href="{{ route('courses.create') }}" class="btn-add">
                    + Tambah Kursus
                </a>

            </div>

            @if (session('success'))
                <div class="alert-success mb-4">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="course-table">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Nama Kursus</th>
                            <th>Biaya</th>
                            <th>Kuota</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($courses as $course)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="course-code">
                                        {{ $course->code }}
                                    </span>
                                </td>

                                <td>
                                    <span class="course-name">
                                        {{ $course->name }}
                                    </span>
                                </td>

                                <td>
                                    <span class="course-fee">
                                        Rp {{ number_format($course->fee, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td>
                                    {{ $course->quota }} peserta
                                </td>

                                <td>
                                    {{ $course->start_date?->format('d/m/Y') ?? '-' }}
                                </td>

                                <td>
                                    @if ($course->status == 'open')

                                        <span class="status-badge status-open">
                                            Dibuka
                                        </span>

                                    @elseif ($course->status == 'draft')

                                        <span class="status-badge status-draft">
                                            Draft
                                        </span>

                                    @else

                                        <span class="status-badge status-closed">
                                            Ditutup
                                        </span>

                                    @endif
                                </td>

                                {{-- TOMBOL AKSI --}}
                                <td>
                                    <div class="action-buttons">

                                        <a href="{{ route('courses.show', $course) }}"
                                           class="btn btn-sm btn-detail">
                                            Detail
                                        </a>

                                        <a href="{{ route('courses.edit', $course) }}"
                                           class="btn btn-sm btn-edit">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('courses.destroy', $course) }}"
                                              onsubmit="return confirm('Apakah kamu yakin ingin menghapus kursus ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-delete">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="empty-data">
                                    Belum ada data kursus.
                                    Silakan tambahkan kursus terlebih dahulu.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

            <div class="mt-3 text-secondary">
                Total kursus:
                <strong>{{ $courses->count() }} kursus</strong>
            </div>

        </div>
    </div>
</div>

@endsection
