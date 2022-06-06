<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->segment(4) ?? '';

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', "unique:users,email,{$id},id"],
            'telephone' => ['nullable', 'string', 'min:3', 'max:15', "unique:users,telephone,{$id},id"],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'string', 'min:6', 'max:16'];
            $rules['roles'] = ['required'];
        }

        return $rules;
    }
}
