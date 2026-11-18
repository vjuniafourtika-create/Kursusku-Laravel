
@extends('layouts.app')

@section('content')

<style>
    .edit-wrapper {
        background: #f0f7ff;
        min-height: 85vh;
        padding: 35px 15px;
        border-radius: 18px;
    }

    .edit-card {
        background: white;
        border: 1px solid #d9eaff;
        border-radius: 18px;
        box-shadow: 0 5px 20px rgba(70, 130, 190, 0.08);
        overflow: hidden;
    }

    .edit-header {
        background: linear-gradient(135deg, #dceeff, #b9dcff);
        padding: 22px 25px;
        color: #245b91;
    }

    .edit-body {
        padding: 25px;
    }

    .form-label {
        color: #315d85;
        font-weight: 600;
    }

    .form-control, .form-select {
        border: 1px solid #c9def2;
        border-radius: 9px;
        padding: 11px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #5798db;
        box-shadow: 0 0 0 3px rgba(87,152,219,.12);
    }

    .btn-save {
        background: #5798db;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 11px 22px;
    }

    .btn-save:hover {
        background: #367fc9;
        color: white;
    }
</style>

<div class="edit-wrapper">

    <div class="container">

        <div class="mb-4">
            <h2 class="fw-bold" style="color:#285f94">
                Edit Kursus
            </h2>

            <p class="text-muted">
                Perbarui informasi kursus pada KursusKu.
            </p>
        </div>

        <div class="edit-card">

            <div class="edit-header">
                <h4 class="fw-bold mb-1">
                    Form Edit Kursus
                </h4>

                <small>
                    Kode: {{ $course->code }}
                </small>
            </div>

            <form method="POST"
                  action="{{ route('courses.update', $course) }}">

                @csrf
                @method('PUT')

                <div class="edit-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Periksa kembali data yang kamu masukkan.
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="code" class="form-label">
                            Kode Kursus
                        </label>

                        <input type="text"
                               id="code"
                               name="code"
                               value="{{ old('code', $course->code) }}"
                               class="form-control @error('code') is-invalid @enderror">

                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nama Kursus
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $course->name) }}"
                               class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            Deskripsi
                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="fee" class="form-label">
                                Biaya Kursus (Rp)
                            </label>

                            <input type="number"
                                   id="fee"
                                   name="fee"
                                   min="0"
                                   value="{{ old('fee', $course->fee) }}"
                                   class="form-control @error('fee') is-invalid @enderror">

                            @error('fee')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="quota" class="form-label">
                                Kuota Peserta
                            </label>

                            <input type="number"
                                   id="quota"
                                   name="quota"
                                   min="1"
                                   max="500"
                                   value="{{ old('quota', $course->quota) }}"
                                   class="form-control @error('quota') is-invalid @enderror">

                            @error('quota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">
                                Tanggal Mulai
                            </label>

                            <input type="date"
                                   id="start_date"
                                   name="start_date"
                                   value="{{ old('start_date', $course->start_date?->format('Y-m-d')) }}"
                                   class="form-control @error('start_date') is-invalid @enderror">

                            @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">
                                Status Kursus
                            </label>

                            <select id="status"
                                    name="status"
                                    class="form-select @error('status') is-invalid @enderror">

                                @foreach ([
                                    'draft' => 'Draft',
                                    'open' => 'Open',
                                    'closed' => 'Closed'
                                ] as $value => $label)

                                    <option value="{{ $value }}"
                                        @selected(old('status', $course->status) === $value)>
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2
                            p-4 border-top flex-wrap">

                    <a href="{{ route('courses.show', $course) }}"
                       class="btn btn-outline-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn-save">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
