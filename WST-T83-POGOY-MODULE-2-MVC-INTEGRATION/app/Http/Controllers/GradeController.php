<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Enrollment $enrollment)
    {
        $grades = Grade::with('subject')
            ->where('enrollment_id', $enrollment->id)
            ->get();
        $subjects = Subject::where('course', $enrollment->course)
            ->where('year_level', $enrollment->year_level)
            ->where('semester', $enrollment->semester)
            ->get();
            
        return view('admin.grades.index', compact('enrollment', 'grades', 'subjects'));
    }

    public function store(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'midterm' => 'nullable|numeric|min:0|max:100',
            'finals' => 'nullable|numeric|min:0|max:100'
        ]);

        $grade = new Grade($validated);
        $grade->enrollment_id = $enrollment->id;
        
        if ($validated['midterm'] !== null && $validated['finals'] !== null) {
            $grade->final_grade = ($validated['midterm'] + $validated['finals']) / 2;
            $grade->remarks = $grade->final_grade >= 75 ? 'Passed' : 'Failed';
        }
        
        $grade->save();

        return redirect()->back()->with('success', 'Grade added successfully.');
    }

    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'midterm' => 'nullable|numeric|min:0|max:100',
            'finals' => 'nullable|numeric|min:0|max:100'
        ]);

        $grade->fill($validated);
        
        if ($grade->midterm !== null && $grade->finals !== null) {
            $grade->final_grade = ($grade->midterm + $grade->finals) / 2;
            $grade->remarks = $grade->final_grade >= 75 ? 'Passed' : 'Failed';
        }
        
        $grade->save();

        return redirect()->back()->with('success', 'Grade updated successfully.');
    }
}