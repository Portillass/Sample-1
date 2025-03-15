<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\User;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::where('is_archived', false);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('last_name', 'LIKE', "%{$search}%")
                ->orWhere('course', 'LIKE', "%{$search}%");
            });
        }

        $enrollments = $query->latest()->paginate(10);
        $subjects = Subject::where('is_archived', false)->get();

        return view('admin.enrollments.index', compact('enrollments', 'subjects'));
    }

    public function create()
    {
        return view('admin.enrollments.create');
    }

    public function edit(Enrollment $enrollment)
    {
        return view('admin.enrollments.edit', compact('enrollment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'contact_number' => 'required|string',
            'course' => 'required|string',
            'year_level' => 'required|integer',
            'semester' => 'required|string',
            'academic_year' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'zip_code' => 'required|string',
            'emergency_contact' => 'required|string',
            'emergency_number' => 'required|string',
        ]);

        Enrollment::create($validated);

        return redirect()->route('enrollments.index')
            ->with('success', 'Student enrolled successfully.');
    }
    public function update(Request $request, Enrollment $enrollment)
{
    $validated = $request->validate([
        'email' => 'required|email|exists:users,email',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'birth_date' => 'required|date',
        'gender' => 'required|string',
        'contact_number' => 'required|string',
        'course' => 'required|string',
        'year_level' => 'required|integer',
        'semester' => 'required|string',
        'academic_year' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'province' => 'required|string',
        'zip_code' => 'required|string',
        'emergency_contact' => 'required|string',
        'emergency_number' => 'required|string',
    ]);

    $enrollment->update($validated);

    return redirect()->route('enrollments.index')
        ->with('success', 'Student updated successfully.');
}
    public function archive(Enrollment $enrollment)
    {
        $enrollment->update(['is_archived' => true]);
        return redirect()->route('enrollments.index')->with('success', 'Student archived successfully.');
    }

    public function archived()
    {
        $enrollments = Enrollment::where('is_archived', true)->latest()->paginate(10);
        return view('admin.enrollments.archived', compact('enrollments'));
    }

    public function restore(Enrollment $enrollment)
    {
        $enrollment->update(['is_archived' => false]);
        return redirect()->route('enrollments.archived')->with('success', 'Student restored successfully.');
    }
    public function enrollSubjects(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id'
        ]);

        $enrollment->subjects()->attach($validated['subjects']);

        return redirect()->back()->with('success', 'Subjects enrolled successfully.');
    }
    public function subjects(Enrollment $enrollment)
    {
        // Get available subjects for this student's course and year level
        $subjects = Subject::where('is_archived', false)
            ->where('course', $enrollment->course)
            ->where('year_level', $enrollment->year_level)
            ->where('semester', $enrollment->semester)
            ->get();

        return view('admin.enrollments.subjects', compact('enrollment', 'subjects'));
    }

    public function dropSubject(Enrollment $enrollment, Subject $subject)
    {
        $enrollment->subjects()->detach($subject->id);
        return redirect()->back()->with('success', 'Subject dropped successfully.');
    }
}