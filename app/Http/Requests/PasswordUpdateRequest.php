<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => ['required', 'min:8'],
            'new_password' => ['required', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => '「旧パスワード」は入力必須です。',
            'current_password.min' => '「旧パスワード」は8文字以上入力してください。',
            'new_password.required' => '「新パスワード」は入力必須です。',
            'new_password.min' => '「新パスワード」は8文字以上入力してください。',
            'new_password.confirmed' => '「新パスワード」と一致しません。',
            'new_password_confirmation.required' => '「新パスワード（確認）」は入力必須です。',
            'new_password_confirmation.min' => '「新パスワード（確認）」は8文字以上入力してください。',
        ];
    }
}
