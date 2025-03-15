<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;

class LessonStudentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {

            case 'POST':
                return [
                    'semester'      => 'required',
                    'lesson_id'     => 'required|exists:lessons,id',
                    'department_id' => 'required|exists:departments,id',
                    'student_id'    => 'required|exists:students,id'
                ];
                break;

            case 'PUT':

                return [
                    'semester'      => 'required',
                    'lesson_id'     => 'required|exists:lessons,id',
                    'department_id' => 'required|exists:departments,id',
                    'student_id'    => 'required|exists:students,id'
                ];

                break;

        }
    }

    /**
     * Get human-friendly attribute names
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'semester'      => 'Sömestır',
            'lesson_id'     => 'Ders',
            'department_id' => 'Bölüm',
            'student_id'    => 'Öğrenci'
        ];
    }
}
