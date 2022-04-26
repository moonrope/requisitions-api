<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=> [
                'required',
                'string',
            // This will be hidden to avoid making the user password too complex
//                Password::min(8)
//                    ->mixedCase()
//                    ->numbers()
//                    ->symbols()
//                    ->uncompromised(),
            ],
            'confirm_password' => 'required|same:password',
        ];
    }

    public function passedValidation(){
        $this->merge(['password' => bcrypt($this->get('password'))]);
    }
}
