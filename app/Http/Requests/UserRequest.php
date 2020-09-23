<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        return [
            'email' => "required|email|unique:users,email,{$user->email}",
            'password' => 'required|min:8|max:64',
            'name' => 'required|min:3|max:30',
            'surname' => 'required|min:3|max:30',
            'patronymic' => 'required|min:3|max:30',
        ];
    }
}
