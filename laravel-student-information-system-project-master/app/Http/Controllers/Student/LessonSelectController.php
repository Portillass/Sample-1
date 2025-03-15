<?php

namespace App\Http\Controllers\Student;

use App\LessonDepartment;
use App\LessonStudent;
use App\Score;
use Carbon\Carbon;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LessonSelectController extends Controller
{

    protected $student;

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

        if (!config('obs.lesson-select')) {
            return redirect()->route('student.lessons.index')
                ->withErrors('Derse yazılma kapalı');
        }


        $year          = config('obs.current.year');
        $semester      = config('obs.current.semester');
        $grade         = $this->user->student->grade;
        $department_id = $this->user->student->department_id;

        $lessons = LessonDepartment::with('lesson')->where('year', $year)
            ->where('semester', $semester)
            ->where('grade', $grade)
            ->where('department_id', $department_id)
            ->get();

        $selectedLessons = LessonStudent::with('lesson')->where('year', $year)
            ->where('semester', $semester)
            ->where('grade', $grade)
            ->where('department_id', $department_id)
            ->where('student_id', $this->user->student->id)
            ->get();


        $totalCredit = 0;

        $selectedLessonsIDListArray = [];

        foreach ($selectedLessons as $selectedLesson) {
            array_push($selectedLessonsIDListArray, $selectedLesson->lesson_id);
            $totalCredit += $selectedLesson->lesson->credit;
        }


        return view('sections.student.lesson-select.index',
            compact('lessons', 'selectedLessonsIDListArray', 'totalCredit', 'lastDate'));
    }

    /**
     * Select lesson by id
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleLesson($id)
    {

        $year          = config('obs.current.year');
        $semester      = config('obs.current.semester');
        $grade         = $this->user->student->grade;
        $department_id = $this->user->student->department_id;
        $student_id    = $this->user->student->id;

        $theLesson = LessonStudent::where('year', $year)
            ->where('semester', $semester)
            ->where('grade', $grade)
            ->where('department_id', $department_id)
            ->where('student_id', $this->user->student->id)
            ->where('lesson_id', $id);

        if (!$theLesson->exists()) {
            $lessonStudent = LessonStudent::create([
                'year'          => $year,
                'semester'      => $semester,
                'grade'         => $grade,
                'department_id' => $department_id,
                'lesson_id'     => $id,
                'student_id'    => $student_id
            ]);

            Score::create([
                'year'              => $year,
                'semester'          => $semester,
                'grade'             => $grade,
                'department_id'     => $department_id,
                'lesson_id'         => $id,
                'student_id'        => $student_id,
                'lesson_student_id' => $lessonStudent->id
            ]);

        } else {
            $theLesson->delete();
        }

        return redirect()->route('student.lesson-select.index');
    }
}
