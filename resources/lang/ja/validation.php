<?php

return [

    'required' => ':attributeは入力必須です',
    'min' => [
        'string' => ':attributeは:min文字以上入力してください',
    ],
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください',
    ],
    'confirmed' => '新パスワードと一致しません',
    'email' => ':attributeの形式で入力してください',
    'regex' => ':attributeの形式が正しくありません',

    'attributes' => [
        'user_name' => 'ユーザー名',
        'user_name_kana' => 'ユーザー名カナ',
        'email' => 'メールアドレス',
        'current_password' => '旧パスワード',
        'new_password' => '新パスワード',
        'new_password_confirmation' => '新パスワード確認',
    ],
];
