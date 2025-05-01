<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "name" => ['required', 'max:255', 'string'],
            "email" => ['required', 'email', 'unique:users,email', 'max:255'],
            "password_1" => ['required', 'same:password_2', "min:8"],
            "password_2" => ['required', 'same:password_1', "min:8"],
        ];
    }
}
