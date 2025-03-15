<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;

class LessonRequest extends Request
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
                    'code'        => 'required|unique:lessons',
                    'name'        => 'required',
                    'credit'      => 'required|integer',
                    'lecturer_id' => 'required|exists:lecturers,id'
                ];
                break;

            case 'PUT':

                return [
                    'code'        => 'required|unique:lessons,code,' . $this->id,
                    'name'        => 'required',
                    'credit'      => 'required|integer',
                    'lecturer_id' => 'required|exists:lecturers,id'
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
            'code'        => 'Ders Kodu',
            'name'        => 'Ders Adı',
            'lecturer_id' => 'Öğretim Görevlisi'
        ];
    }
}
