<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    // Menampilkan kursus dengan fitur pencarian, filter, dan pagination
    public function index(Request $request)
    {
        // Mengambil kata kunci pencarian
        $search = trim((string) $request->query('q'));

        // Mengambil status yang dipilih
        $status = trim((string) $request->query('status'));

        // Status yang diperbolehkan
        $allowedStatuses = ['open', 'closed', 'draft'];

        // Membuat query kursus
        $courses = Course::query()

            // Pencarian berdasarkan kode atau nama kursus
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");
                });
            })

            // Filter berdasarkan status
            ->when(
                in_array($status, $allowedStatuses, true),
                function ($query) use ($status) {
                    $query->where('status', $status);
                }
            )

            // Mengurutkan kursus berdasarkan nama
            ->orderBy('name')

            // Maksimal 10 data setiap halaman
            ->paginate(10)

            // Mempertahankan parameter pencarian dan filter
            ->withQueryString();

        return view('courses.index', compact(
            'courses',
            'search',
            'status'
        ));
    }

    // Menampilkan form tambah kursus
    public function create()
    {
        return view('courses.create');
    }

    // Menyimpan kursus baru
    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());

        return to_route('courses.index')
            ->with('success', 'Kursus berhasil ditambahkan.');
    }

    // Menampilkan detail kursus
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    // Menampilkan form edit
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Memperbarui kursus
    public function update(
        UpdateCourseRequest $request,
        Course $course
    ) {
        $course->update($request->validated());

        return to_route('courses.show', $course)
            ->with('success', 'Kursus berhasil diperbarui.');
    }

    // Menghapus kursus
    public function destroy(Course $course)
    {
        $course->delete();

        return to_route('courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}
