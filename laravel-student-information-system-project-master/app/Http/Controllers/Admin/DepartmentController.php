<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Department;
use App\Http\Requests\Admin\DepartmentRequest;
use App\Http\Requests;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::paginate(15);

        return view('sections.admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sections.admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        Department::create($request->all());

        return redirect()->route('admin.departments.index')->with('success', 'Bölüm oluşturuldu');
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

            $department = Department::findOrFail($id);

            return view('sections.admin.departments.edit', compact('department'));

        } catch (\Exception $e) {

            return redirect()->route('admin.departments.index')->withErrors('Bölüm bulunamadı');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        try {

            Department::findOrFail($id)->update($request->all());

            return redirect()->route('admin.departments.index')->with('success', 'Bölüm güncellendi');

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

                /** @var Department $department */
                $department = Department::findOrFail($id);

                if ($department->students()->count()) {
                    return response()->json(['error' => true, 'message' => 'Bu bölüme kayıtlı öğrenciler var']);
                }

                $department->delete();

                \Session::flash('success', 'Kayıt başarıyla silindi');

            } catch (\Exception $e) {

                return response()->json(['error' => true, 'message' => 'Hata meydana geldi. ' . $e->getMessage()]);

            }

        }
    }
}
