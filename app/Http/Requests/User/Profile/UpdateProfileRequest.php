<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'name_kana'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'          => '氏名',
            'name_kana'     => '氏名（カナ）',
            'email'         => 'メールアドレス',
            'profile_image' => 'プロフィール画像',
        ];
    }
}
