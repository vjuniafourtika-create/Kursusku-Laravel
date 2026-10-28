
<?php

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
            'course' => 'Laravel Fundamental',
            'remaining' => 4,
        ],
    ];

    abort_unless(isset($availability[$course]), 404);

    return response()->json($availability[$course]);
})->name('courses.availability');
