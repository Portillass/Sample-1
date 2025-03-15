<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonStudentRequest;
use App\Lesson;
use App\LessonStudent;
use App\Score;
use Illuminate\Http\Request;
use App\Http\Requests;

class LessonStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessonsStudents = LessonStudent::with('lesson.lecturer', 'department', 'student.user')->paginate(15);

        return view('sections.admin.lessons-students.index', compact('lessonsStudents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sections.admin.lessons-students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonStudentRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LessonStudentRequest $request)
    {

        $semester     = $request->input('semester');
        $lessonID     = $request->input('lesson_id');
        $departmentID = $request->input('department_id');
        $studentID    = $request->input('student_id');

        if (LessonStudent::where('semester', $semester)
            ->where('lesson_id', $lessonID)
            ->where('department_id', $departmentID)
            ->where('student_id', $studentID)
            ->count()
        ) {
            return redirect()->back()->withErrors('Bu atama zaten yapılmış');
        }

        $lesson = Lesson::findOrFail($lessonID);

        $request->merge([
            'grade' => $lesson->grade,
            'year'  => config('obs.current.year')
        ]);

        $lessonStudent = LessonStudent::create($request->all());

        Score::create([
            'year'              => $lessonStudent->year,
            'semester'          => $lessonStudent->semester,
            'grade'             => $lessonStudent->grade,
            'department_id'     => $lessonStudent->department_id,
            'lesson_id'         => $lessonStudent->lesson_id,
            'student_id'        => $lessonStudent->student_id,
            'lesson_student_id' => $lessonStudent->id
        ]);

        return redirect()->route('admin.lessons-students.index')->with('success', 'Atama eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Request::ajax()) {

            try {

                LessonStudent::findOrFail($id)->delete();

                \Session::flash('success', 'Kayıt başarıyla silindi');

            } catch (\Exception $e) {

                return response()->json(['error' => true, 'message' => 'Hata meydana geldi. ' . $e->getMessage()]);

            }

        }
    }
}
