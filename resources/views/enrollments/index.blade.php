
@extends('layouts.app')

@section('content')
<style>
    .kk-report {
        --kk-blue: #2563eb;
        max-width: 1150px;
        margin: 30px auto;
        padding: 0 20px;
        color: #172554;
    }

    .kk-report * {
        box-sizing: border-box;
    }

    .kk-report-hero {
        padding: 32px;
        border-radius: 22px;
        color: white;
        background: linear-gradient(125deg, #102a56, #2563eb, #60a5fa);
        box-shadow: 0 15px 35px rgba(37, 99, 235, .16);
    }

    .kk-report-hero h1 {
        margin: 0 0 10px;
        font-size: clamp(25px, 4vw, 34px);
    }

    .kk-report-hero p {
        margin: 0;
        color: #e0ecff;
        line-height: 1.7;
    }

    .kk-report-panel {
        margin-top: 24px;
        padding: 24px;
        border: 1px solid #dbeafe;
        border-radius: 20px;
        background: white;
        box-shadow: 0 10px 30px rgba(15, 45, 90, .06);
    }

    .kk-report-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 20px;
    }

    .kk-report-toolbar h2 {
        margin: 0;
        font-size: 21px;
        color: #173568;
    }

    .kk-report-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 18px;
        border-radius: 11px;
        color: white;
        background: #2563eb;
        font-weight: 700;
        text-decoration: none;
    }

    .kk-report-btn:hover {
        background: #1e40af;
    }

    .kk-report-success {
        margin-bottom: 20px;
        padding: 14px 16px;
        color: #166534;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
    }

    .kk-table-wrap {
        overflow-x: auto;
        border: 1px solid #dbeafe;
        border-radius: 14px;
    }

    .kk-report table {
        width: 100%;
        border-collapse: collapse;
        min-width: 650px;
    }

    .kk-report th {
        padding: 15px;
        text-align: left;
        color: #fff;
        background: #173568;
        font-size: 13px;
        letter-spacing: .3px;
    }

    .kk-report td {
        padding: 16px 15px;
        border-bottom: 1px solid #e5edf9;
        color: #334155;
        vertical-align: middle;
    }

    .kk-report tbody tr:nth-child(even) {
        background: #f8fbff;
    }

    .kk-report tbody tr:hover {
        background: #eff6ff;
    }

    .kk-status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 999px;
        color: #1d4ed8;
        background: #dbeafe;
        font-size: 12px;
        font-weight: 800;
    }

    .kk-report-empty {
        padding: 28px;
        text-align: center;
        color: #64748b;
    }
</style>

<div class="kk-report">
    <section class="kk-report-hero">
        <h1>Laporan Enrollment KursusKu</h1>
        <p>
            Pantau data pendaftaran peserta, kursus yang diikuti,
            tanggal mulai, dan status pendaftaran dalam satu halaman.
        </p>
    </section>

    <section class="kk-report-panel">
        @if (session('success'))
            <div class="kk-report-success" role="status">
                {{ session('success') }}
            </div>
        @endif

        <div class="kk-report-toolbar">
            <h2>Data Pendaftaran</h2>

            <a
                href="{{ route('enrollments.create') }}"
                class="kk-report-btn"
            >
                + Tambah Enrollment
            </a>
        </div>

        <div class="kk-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Peserta</th>
                        <th>Kursus</th>
                        <th>Tanggal Mulai</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $enrollment->participant->name }}
                            </td>

                            <td>
                                {{ $enrollment->course->name }}
                            </td>

                            <td>
                                @if ($enrollment->course->start_date)
                                    {{ \Illuminate\Support\Carbon::parse(
                                        $enrollment->course->start_date
                                    )->format('d-m-Y') }}
                                @else
                                    Belum ditentukan
                                @endif
                            </td>

                            <td>
                                <span class="kk-status">
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="kk-report-empty">
                                    Belum ada pendaftaran kursus.
                                    Silakan tambahkan enrollment pertama.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
