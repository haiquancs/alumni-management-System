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
            'email' => 'regex:/^[A-Za-z0-9_.]*@gmail.com$/',
        ];
    }

    public function messages()
    {
        return [
            'email.regex' => 'Email không đúng định dạng',
        ];
    }

}
