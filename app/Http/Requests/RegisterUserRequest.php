<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認可不要なら true
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
            'email' => 'required|string|email|min:8|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9]+$/', // 半角英数字のみ
                'min:8',
                'max:255',
                'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            // ユーザーネーム
            'name.required' => 'ユーザーネームを入力してください。',
            'name.max' => '255字以内で入力してください。',

            // カナ
            'name_kana.required' => 'カナを入力してください。',
            'name_kana.max' => '255字以内で入力してください。',

            // メールアドレス
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しい形式で入力してください。',
            'email.min' => '8文字以上で入力してください。',
            'email.max' => '255字以内で入力してください。',

            // パスワード
            'password.required' => 'パスワードを入力してください。',
            'password.regex' => '使用できない文字が含まれています。',
            'password.min' => '8文字以上の、半角英数字で入力してください。',
            'password.max' => '255字以内で入力してください。',
            'password.confirmed' => 'パスワード確認が一致していません。',
        ];
    }
}
