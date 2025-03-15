<?php

namespace App\Http\Controllers\Lecturer;

use App\Lesson;
use App\LessonDepartment;
use App\Score;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScoreController extends Controller
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
        $department_id = $this->user->lecturer->department_id;

        $lesson_id = LessonDepartment::where('year', $year)
            ->where('semester', $semester)
            ->where('department_id', $department_id)
            ->value('lesson_id');

        $scores = Score::where('year', $year)
            ->where('semester', $semester)
            ->where('department_id', $department_id)
            ->where('lesson_id', $lesson_id)
            ->get();


        return view('sections.lecturer.scores.index', compact('scores'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $year          = config('obs.current.year');
        $semester      = config('obs.current.semester');
        $department_id = $this->user->lecturer->department_id;

        $lesson_id = LessonDepartment::where('year', $year)
            ->where('semester', $semester)
            ->where('department_id', $department_id)
            ->value('lesson_id');

        $scoreArray = [];

        $studentIDArray = $request->get('student_id');

        foreach ($studentIDArray as $index => $student_id) {

            $midterm_score = $request->get('midterm_score')[$index];
            $final_score = $request->get('final_score')[$index];
            $avarage_score = NULL;
            $avarage_score_letter = NULL;

            $data = [];


            if(!is_null($final_score) && $final_score >= 0) {
                $data['final_score'] = $final_score;
            }

            if(!is_null($midterm_score) && $midterm_score >=0) {
                $data['midterm_score'] = $midterm_score;
            }

            if(!is_null($final_score) && !is_null($midterm_score)) {
                $data['avarage_score'] = ($midterm_score * .4) + ($final_score * .6);
                $data['avarage_score_letter'] = Score::scoreAsLetter($avarage_score);

                Score::where('year', $year)
                    ->where('semester', $semester)
                    ->where('department_id', $department_id)
                    ->where('lesson_id', $lesson_id)
                    ->where('student_id',$student_id)
                    ->update($data);
            }




        }

        return redirect()->route('lecturer.scores.index')->with('success','Notlar güncellendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
