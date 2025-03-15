<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonDepartmentRequest;
use App\Lesson;
use App\LessonDepartment;
use Illuminate\Http\Request;
use App\Http\Requests;

class LessonDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessonsDepartments = LessonDepartment::with('lesson.lecturer', 'department')->paginate(15);

        return view('sections.admin.lessons-departments.index', compact('lessonsDepartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sections.admin.lessons-departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonDepartmentRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LessonDepartmentRequest $request)
    {
        if (LessonDepartment::where('semester', $request->input('semester'))
            ->where('lesson_id', $request->input('lesson_id'))
            ->where('department_id', $request->input('department_id'))
            ->count()
        ) {
            return redirect()->back()->withErrors('Bu atama zaten yapılmış');
        }

        $lesson = Lesson::findOrFail($request->get('lesson_id'));

        $request->merge(['grade' => $lesson->grade]);

        LessonDepartment::create($request->all());

        return redirect()->route('admin.lessons-departments.index')->with('success', 'Atama eklendi');
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
        try {

            $lessonDepartment = LessonDepartment::findOrFail($id);

            return view('sections.admin.lessons-departments.edit', compact('lessonDepartment'));

        } catch (\Exception $e) {

            return redirect()->route('admin.lessons-departments.index')->withErrors('Atama bulunamadı');

        }
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

                LessonDepartment::findOrFail($id)->delete();

                \Session::flash('success', 'Kayıt başarıyla silindi');

            } catch (\Exception $e) {

                return response()->json(['error' => true, 'message' => 'Hata meydana geldi. ' . $e->getMessage()]);

            }

        }
    }
}
