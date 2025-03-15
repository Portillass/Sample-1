<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;

class LecturerRequest extends Request
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
    public function rules() {
        switch ( $this->method() ) {

            case 'POST':
                return [
                    'department_id' => 'required',
                    'name'          => 'required',
                    'surname'       => 'required',
                    'username'      => 'required|unique:users',
                    'password'      => 'required'
                ];
                break;

            case 'PUT':

                return [
                    'department_id' => 'required',
                    'name'          => 'required',
                    'surname'       => 'required',
                    'username'      => 'required|unique:users,username,'.$this->user_id,
                    'password'      => 'confirmed'
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
            'department_id'         => 'Bölüm',
            'name'                  => 'Adı',
            'surname'               => 'Soyadı',
            'username'              => 'Email',
            'password'              => 'Şifre',
            'password_confirmation' => 'Şifre Tekrar'
        ];
    }
}
