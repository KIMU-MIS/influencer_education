<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'new_password'     => 'required|string|min:8|confirmed',
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => '現在のパスワード',
            'new_password'     => '新しいパスワード',
        ];
    }
}
