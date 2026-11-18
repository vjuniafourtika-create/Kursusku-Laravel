<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with([
            'participant',
            'course'
        ])
        ->latest()
        ->get();

        return view(
            'enrollments.index',
            compact('enrollments')
        );
    }

    public function create()
    {
        $participants = Participant::orderBy('name')->get();

        $courses = Course::orderBy('name')->get();
           
        return view(
            'enrollments.create',
            compact('participants', 'courses')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'participant_id' => [
                    'required',
                    'exists:participants,id'
                ],

                'course_id' => [
                    'required',
                    'exists:courses,id',

                    Rule::unique('enrollments')->where(
                        fn ($query) => $query->where(
                            'participant_id',
                            $request->participant_id
                        )
                    ),
                ],
            ],
            [
                'participant_id.required' =>
                    'Silakan pilih peserta.',

                'course_id.required' =>
                    'Silakan pilih kursus.',

                'course_id.unique' =>
                    'Peserta ini sudah terdaftar pada kursus tersebut.',
            ]
        );

        $data['status'] = 'registered';

        Enrollment::create($data);

        return redirect()
            ->route('enrollments.index')
            ->with(
                'success',
                'Pendaftaran kursus berhasil disimpan!'
            );
    }
}
