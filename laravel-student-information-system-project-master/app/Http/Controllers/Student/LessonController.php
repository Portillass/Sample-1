<?php

namespace App\Http\Controllers\Student;

use App\LessonStudent;
use App\Score;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{

    public function __construct(Guard $auth)
    {
        $this->user = $auth->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year          = config('obs.current.year');
        $semester      = config('obs.current.semester');
        $grade         = $this->user->student->grade;
        $department_id = $this->user->student->department_id;

        $lessons = LessonStudent::with('lesson.lecturer','score')
            ->where('year', $year)
            ->where('semester', $semester)
            ->where('grade', $grade)
            ->where('department_id', $department_id)
            ->where('student_id', $this->user->student->id)
            ->get();




        return view('sections.student.lessons.index',compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
