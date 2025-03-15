<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;

class UserRequest extends Request
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
                    'username' => 'required|unique:users',
                    'password' => 'required'
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
            'username' => 'Öğrenci No',
            'password' => 'Şifre'
        ];
    }
}
