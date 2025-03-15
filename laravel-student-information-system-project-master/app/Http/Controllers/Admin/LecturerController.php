<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Department;
use App\Http\Requests\Admin\LecturerRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Lecturer;
use App\Role;
use App\User;
use App\Http\Requests;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturers = Lecturer::with('user')->paginate(15);

        return view('sections.admin.lecturers.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if ( ! Department::count()) {
            return redirect()->route('admin.lecturers.index')->withErrors('Bölüm eklemeden öğretim görevlisi ekleyemezsiniz!');
        }

        return view('sections.admin.lecturers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $userRequest
     * @param LecturerRequest $lecturerRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $userRequest, LecturerRequest $lecturerRequest)
    {
        $user = User::create($userRequest->all());

        $user->lecturer()->create($lecturerRequest->all());

        $role = Role::byName('lecturer');

        $user->attachRole($role);

        return redirect()->route('admin.lecturers.index')->with('success', 'Öğretim görevlisi başarıyla eklendi');
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

            $lecturer = Lecturer::findOrFail($id);

            return view('sections.admin.lecturers.edit', compact('lecturer'));

        } catch (\Exception $e) {

            return redirect()->route('admin.lecturers.index')->withErrors('Öğretim görevlisi bulunamadı');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LecturerRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LecturerRequest $request, $id)
    {
        try {

            Lecturer::findOrFail($id)->update($request->all());

            return redirect()->route('admin.lecturers.index')->with('success', 'Öğretim görevlisi güncellendi');

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

                User::findOrFail($id)->delete();

                \Session::flash('success', 'Kayıt başarıyla silindi');

            } catch (\Exception $e) {

                return response()->json(['error' => true, 'message' => 'Hata meydana geldi. ' . $e->getMessage()]);

            }

        }
    }
}
