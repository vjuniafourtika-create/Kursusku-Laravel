
@extends('layouts.app')

@section('content')

<style>
    .course-page {
        min-height: 100vh;
        padding: 45px 20px;
        background: linear-gradient(135deg, #eaf2ff, #f5f8ff);
    }

    .course-container {
        max-width: 1000px;
        margin: auto;
    }

    .course-card {
        background: white;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 10px 35px rgba(30, 64, 175, 0.12);
        border: 1px solid #e0eaff;
    }

    .course-heading {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 25px;
        padding-bottom: 22px;
        border-bottom: 2px solid #e5edff;
    }

    .heading-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        background: linear-gradient(135deg, #2563eb, #60a5fa);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
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

    .form-label {
        color: #203b68;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .form-control, .form-select {
        border: 1px solid #d5e2f5;
        border-radius: 10px;
        padding: 12px 15px;
        min-height: 48px;
        transition: 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.13);
    }

    textarea.form-control {
        min-height: 115px;
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    .btn-save {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #1e40af;
        color: white;
    }

    .btn-cancel {
        background: #eef4ff;
        color: #2454a6;
        border: 1px solid #d7e5ff;
        border-radius: 10px;
        padding: 12px 22px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #dceaff;
        color: #173b79;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        border-top: 1px solid #e5edff;
        padding-top: 22px;
        margin-top: 25px;
    }

    .required {
        color: #dc3545;
    }

    @media (max-width: 600px) {
        .course-card {
            padding: 22px 16px;
        }

        .course-heading h2 {
            font-size: 23px;
        }

        .form-footer {
            flex-direction: column;
        }

        .form-footer a, .form-footer button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="course-page">
    <div class="course-container">

        <div class="course-card">

            <div class="course-heading">
                <div class="heading-icon">+</div>
                <div>
                    <h2>Tambah Kursus</h2>
                    <p>Lengkapi informasi kursus yang ingin ditambahkan.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali formulir!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label">
                            Kode Kursus <span class="required">*</span>
                        </label>
                        <input type="text"
                            name="code"
                            class="form-control"
                            placeholder="Contoh: WEB-101"
                            value="{{ old('code') }}"
                            required>
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Nama Kursus <span class="required">*</span>
                        </label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            placeholder="Masukkan nama kursus"
                            value="{{ old('name') }}"
                            required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description"
                            class="form-control"
                            placeholder="Masukkan deskripsi kursus...">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Biaya Kursus (Rp) <span class="required">*</span>
                        </label>
                        <input type="number"
                            name="fee"
                            class="form-control"
                            min="0"
                            placeholder="300000"
                            value="{{ old('fee', 0) }}"
                            required>
                        @error('fee')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Kuota Peserta <span class="required">*</span>
                        </label>
                        <input type="number"
                            name="quota"
                            class="form-control"
                            min="1"
                            max="500"
                            placeholder="20"
                            value="{{ old('quota', 20) }}"
                            required>
                        @error('quota')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Tanggal Mulai <span class="required">*</span>
                        </label>
                        <input type="date"
                            name="start_date"
                            class="form-control"
                            value="{{ old('start_date') }}"
                            required>
                        @error('start_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Status Kursus <span class="required">*</span>
                        </label>
                        <select name="status" class="form-select" required>
                            <option value="">Pilih Status</option>
                            <option value="draft"
                                {{ old('status') == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="open"
                                {{ old('status') == 'open' ? 'selected' : '' }}>
                                Dibuka
                            </option>
                            <option value="closed"
                                {{ old('status') == 'closed' ? 'selected' : '' }}>
                                Ditutup
                            </option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="form-footer">
                    <a href="{{ route('courses.index') }}" class="btn-cancel">
                        Batal
                    </a>

                    <button type="submit" class="btn-save">
                        + Simpan Kursus
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
