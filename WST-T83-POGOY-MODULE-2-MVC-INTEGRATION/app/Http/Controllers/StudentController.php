<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Grade;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $enrollment = Enrollment::where('email', $user->email)->first();
        
        if (!$enrollment) {
            return view('student.not-enrolled', [
                'message' => 'You are not currently enrolled.'
            ]);
        }

        // Load subjects with their grades
        $subjects = Subject::with(['grades' => function($query) use ($enrollment) {
            $query->where('enrollment_id', $enrollment->id);
        }])
        ->whereHas('enrollments', function($query) use ($enrollment) {
            $query->where('enrollment_id', $enrollment->id);
        })
        ->get();

        return view('student.dashboard', compact('enrollment', 'subjects'));
    }
}