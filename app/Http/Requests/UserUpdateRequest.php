<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'is_admin' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email']
        ];
    }

    public function messages():array
    {
        return [
            'required' => "Поле :attribute нужно заполнить!"
        ];    
    }

    public function attributes():array
    {
        return [
            'name' => "имя",
            'email' => "e-mail"
        ];
    }
}
