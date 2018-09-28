<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email' => 'unique:users|regex:/^[A-Za-z0-9_.]*@gmail.com$/',
        ];
    }

    public function messages()
    {
        return [
            'email.regex' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
        ];
    }

}
