
<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Halaman Beranda
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $siteName = 'KursusKu';

    $featured = [
        [
            'code' => 'WEB-01',
            'name' => 'Web Dasar',
            'description' => 'Belajar HTML, CSS, dan dasar pembuatan halaman web.',
        ],
        [
            'code' => 'PHP-01',
            'name' => 'PHP Dasar',
            'description' => 'Belajar PHP untuk membuat aplikasi web dinamis.',
        ],
        [
            'code' => 'LAR-01',
            'name' => 'Laravel Fundamental',
            'description' => 'Mengenal Laravel untuk membangun aplikasi web.',
        ],
    ];

    return view('home', compact('siteName', 'featured'));
})->name('home');


/*
|--------------------------------------------------------------------------
| Halaman Formulir Pendaftaran
|--------------------------------------------------------------------------
*/

Route::get('/pendaftaran', function () {
    $courses = [
        1 => ['name' => 'Web Dasar'],
        2 => ['name' => 'PHP Dasar'],
        3 => ['name' => 'Laravel Fundamental'],
    ];

    return view('enrollments.create', compact('courses'));
})->name('enrollments.create');


/*
|--------------------------------------------------------------------------
| Informasi Ketersediaan Kursus untuk Ajax
|--------------------------------------------------------------------------
*/

Route::get('/courses/{course}/availability', function (int $course) {
    $availability = [
        1 => [
            'course' => 'Web Dasar',
            'remaining' => 12,
        ],
        2 => [
            'course' => 'PHP Dasar',
            'remaining' => 8,
        ],
        3 => [
            'course' => 'Laravel Dasar',
            'remaining' => 4,
        ],
    ];

    abort_unless(isset($availability[$course]), 404);

    return response()->json($availability[$course]);
})->name('courses.availability');


/*
|--------------------------------------------------------------------------
| Validasi Formulir Pendaftaran
|--------------------------------------------------------------------------
*/

Route::post('/pendaftaran/preview', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'min:3', 'max:100'],
        'email' => ['required', 'email'],
        'course_id' => ['required', 'integer', 'in:1,2,3'],
    ]);

    return back()
        ->with(
            'success',
            'Formulir berhasil divalidasi. Database akan ditambahkan pada pertemuan berikutnya.'
        )
        ->withInput();
})->name('enrollments.preview');


/*
|--------------------------------------------------------------------------
| CRUD Kursus
|--------------------------------------------------------------------------
*/

Route::resource('courses', CourseController::class);


Route::get('/test-matrix', function () {
    $testCases = [
        ['no' => 1, 'case' => 'Kode kursus duplikat', 'expected' => 'Ditolak karena kode sudah digunakan'],
        ['no' => 2, 'case' => 'Nama kursus kosong', 'expected' => 'Ditolak karena nama wajib diisi'],
        ['no' => 3, 'case' => 'Nama kursus terlalu pendek (AI)', 'expected' => 'Ditolak karena nama minimal 3 karakter'],
        ['no' => 4, 'case' => 'Biaya negatif (-1000)', 'expected' => 'Ditolak karena biaya minimal 0'],
        ['no' => 5, 'case' => 'Biaya bukan angka (abc)', 'expected' => 'Ditolak karena biaya harus berupa angka'],
        ['no' => 6, 'case' => 'Kuota 0', 'expected' => 'Ditolak karena kuota minimal 1'],
        ['no' => 7, 'case' => 'Kuota 501', 'expected' => 'Ditolak karena kuota maksimal 500'],
        ['no' => 8, 'case' => 'Kuota 1', 'expected' => 'Diterima karena kuota berada pada batas minimum'],
        ['no' => 9, 'case' => 'Kuota 500', 'expected' => 'Diterima karena kuota berada pada batas maksimum'],
        ['no' => 10, 'case' => 'Tanggal tidak valid', 'expected' => 'Ditolak karena format tanggal tidak valid'],
        ['no' => 11, 'case' => 'Status tidak valid (active)', 'expected' => 'Ditolak karena status tidak sesuai pilihan'],
        ['no' => 12, 'case' => 'Update menggunakan kode yang sama', 'expected' => 'Diterima karena kode milik kursus tersebut'],
        ['no' => 13, 'case' => 'Update menggunakan kode milik kursus lain', 'expected' => 'Ditolak karena kode sudah digunakan'],
        ['no' => 14, 'case' => 'Update data kursus normal', 'expected' => 'Diterima dan data berhasil diperbarui'],
        ['no' => 15, 'case' => 'Hapus kursus percobaan', 'expected' => 'Diterima dan data berhasil dihapus'],
    ];

    return view('test-matrix', compact('testCases'));
})->name('test-matrix');
