
@extends('layouts.app')

@section('content')
<style>
    .kk-enroll {
        --kk-blue: #2563eb;
        --kk-dark: #142d59;
        --kk-muted: #64748b;
        max-width: 1000px;
        margin: 30px auto;
        padding: 0 20px;
        color: #172554;
    }

    .kk-enroll * {
        box-sizing: border-box;
    }

    .kk-hero {
        position: relative;
        overflow: hidden;
        padding: 34px;
        border-radius: 24px;
        color: white;
        background: linear-gradient(125deg, #102a56, #2563eb 65%, #60a5fa);
        box-shadow: 0 16px 36px rgba(37, 99, 235, .18);
    }

    .kk-hero h1 {
        margin: 0 0 10px;
        font-size: clamp(26px, 4vw, 36px);
        font-weight: 800;
    }

    .kk-hero p {
        margin: 0;
        color: #e0ecff;
        line-height: 1.7;
    }

    .kk-card {
        margin-top: 24px;
        padding: 28px;
        border: 1px solid #dbeafe;
        border-radius: 22px;
        background: white;
        box-shadow: 0 10px 30px rgba(15, 45, 90, .07);
    }

    .kk-card h2 {
        margin: 0 0 8px;
        color: #173568;
        font-size: 22px;
    }

    .kk-help {
        margin: 0 0 24px;
        color: var(--kk-muted);
        line-height: 1.6;
    }

    .kk-field {
        margin-bottom: 22px;
    }

    .kk-field label {
        display: block;
        margin-bottom: 9px;
        font-weight: 700;
        color: #1e3a68;
    }

    .kk-field select {
        display: block;
        width: 100%;
        min-height: 48px;
        padding: 12px 14px;
        border: 1px solid #cbdaf2;
        border-radius: 12px;
        background: #f8fbff;
        color: #172554;
        font: inherit;
    }

    .kk-field select:focus {
        outline: 3px solid #bfdbfe;
        border-color: #2563eb;
    }

    .kk-error {
        margin-top: 8px;
        color: #b91c1c;
        font-size: 14px;
    }

    .kk-notice {
        margin-bottom: 20px;
        padding: 14px 16px;
        border-radius: 12px;
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }

    .kk-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .kk-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 46px;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        border: 0;
        cursor: pointer;
        transition: .2s ease;
    }

    .kk-btn-primary {
        color: white;
        background: linear-gradient(120deg, #1d4ed8, #3b82f6);
        box-shadow: 0 7px 16px rgba(37, 99, 235, .2);
    }

    .kk-btn-primary:hover {
        background: #1e40af;
        transform: translateY(-1px);
    }

    .kk-btn-secondary {
        color: #1d4ed8;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
    }

    @media (max-width: 600px) {
        .kk-hero, .kk-card {
            padding: 22px;
        }

        .kk-actions .kk-btn {
            width: 100%;
        }
    }
</style>

<div class="kk-enroll">
    <section class="kk-hero">
        <h1>Pendaftaran Kursus</h1>
        <p>
            Mulai perjalanan belajar kamu bersama KursusKu.
            Pilih peserta dan kursus yang tersedia untuk membuat
            pendaftaran baru.
        </p>
    </section>

    <section class="kk-card">
        <h2>Form Enrollment</h2>
        <p class="kk-help">
            Pastikan peserta dan kursus yang dipilih sudah benar.
            Status pendaftaran akan otomatis menjadi Registered.
        </p>

        @if ($errors->any())
            <div class="kk-notice" role="alert">
                <strong>Pendaftaran belum dapat disimpan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($participants->isEmpty())
            <div class="kk-notice">
                Belum ada peserta. Tambahkan peserta terlebih dahulu.
            </div>
        @endif

        @if ($courses->isEmpty())
            <div class="kk-notice">
                Belum ada kursus aktif. Periksa data Course kamu.
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('enrollments.store') }}"
        >
            @csrf

            <div class="kk-field">
                <label for="participant_id">
                    Pilih Peserta
                </label>

                <select
                    id="participant_id"
                    name="participant_id"
                    required
                >
                    <option value="">-- Pilih peserta --</option>

                    @foreach ($participants as $participant)
                        <option
                            value="{{ $participant->id }}"
                            @selected(
                                old('participant_id') == $participant->id
                            )
                        >
                            {{ $participant->name }}
                            — {{ $participant->email }}
                        </option>
                    @endforeach
                </select>

                @error('participant_id')
                    <div class="kk-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="kk-field">
                <label for="course_id">
                    Pilih Kursus
                </label>

                <select
                    id="course_id"
                    name="course_id"
                    required
                >
                    <option value="">-- Pilih kursus --</option>

                    @foreach ($courses as $course)
                        <option
                            value="{{ $course->id }}"
                            @selected(
                                old('course_id') == $course->id
                            )
                        >
                            {{ $course->code }}
                            — {{ $course->name }}
                        </option>
                    @endforeach
                </select>

                @error('course_id')
                    <div class="kk-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="kk-actions">
                <button
                    type="submit"
                    class="kk-btn kk-btn-primary"
                    @disabled(
                        $participants->isEmpty() || $courses->isEmpty()
                    )
                >
                    Simpan Pendaftaran
                </button>

                <a
                    href="{{ route('enrollments.index') }}"
                    class="kk-btn kk-btn-secondary"
                >
                    Lihat Laporan
                </a>
            </div>
        </form>
    </section>
</div>
@endsection
