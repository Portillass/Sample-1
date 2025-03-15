<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonRequest;
use App\Lesson;
use App\Http\Requests;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::with('lecturer')->paginate(15);

        return view('sections.admin.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sections.admin.lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request)
    {
        Lesson::create($request->all());

        return redirect()->route('admin.lessons.index')->with('success', 'Ders eklendi');
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

            $lesson = Lesson::findOrFail($id);

            return view('sections.admin.lessons.edit', compact('lesson'));

        } catch (\Exception $e) {

            return redirect()->route('admin.lessons.index')->withErrors('Ders bulunamadı');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LessonRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $id)
    {
        try {

            Lesson::findOrFail($id)->update($request->all());

            return redirect()->route('admin.lessons.index')->with('success', 'Ders güncellendi');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors('Hata meydana geldi: ' . $e->getMessage());

        }
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

                Lesson::findOrFail($id)->delete();

                \Session::flash('success', 'Kayıt başarıyla silindi');

            } catch (\Exception $e) {

                return response()->json(['error' => true, 'message' => 'Hata meydana geldi. ' . $e->getMessage()]);

            }

        }
    }
}
