<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Department;
use App\Http\Requests\Admin\StudentRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Role;
use App\Student;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $students = Student::with('user')->paginate(15);

        return view('sections.admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if ( ! Department::count()) {
            return redirect()->route('admin.students.index')->withErrors('Bölüm eklemeden öğrenci ekleyemezsiniz!');
        }

        return view('sections.admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $userRequest
     * @param StudentRequest $studentRequest
     *
     * @return Response
     * @internal param Request $request
     */
    public function store(UserRequest $userRequest, StudentRequest $studentRequest)
    {
        $user = User::create($userRequest->all());

        $user->student()->create($studentRequest->all());

        $role = Role::byName('student');

        $user->attachRole($role);

        return redirect()->route('admin.students.index')->with('success', 'Öğrenci başarıyla eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
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
     * @return Response
     */
    public function edit($id)
    {
        try {

            $student = Student::findOrFail($id);

            return view('sections.admin.students.edit', compact('student'));

        } catch (\Exception $e) {

            return redirect()->route('admin.students.index')->withErrors('Öğrenci bulunamadı');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update(StudentRequest $request, $id)
    {
        try {

            $student = Student::findOrFail($id);

            $student->name = $request->get('name');

            $student->surname = $request->get('surname');

            $student->department_id = $request->get('department_id');

            $student->save();

            $user = User::findOrFail($student->user_id);

            $user->username = $request->get('username');

            if ($request->has('password')) {
                $user->password = bcrypt($request->get('password'));
            }

            $user->save();

            return redirect()->route('admin.students.index')->with('success', 'Öğrenci güncellendi');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors('Hata meydana geldi: ' . $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
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
