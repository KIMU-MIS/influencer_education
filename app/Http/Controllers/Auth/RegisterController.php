<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // 登録フォーム
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // 新規登録処理
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // name_kana: 文字数チェックを先に、カナチェックは別ルールで
            'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ヶー　]+$/u'],
            'email'=> ['required', 'email', 'max:255','min:8','unique:users,email'],
            'password' => ['required', 'string', 'max:255','confirmed', 'min:8','regex:/^[a-zA-Z0-9]+$/'],
        ], [
            'name.required' => 'ユーザーネームを入力してください。',
            'name.max' => '255字以内で入力してください。',
            'name_kana.required' => 'カナを入力してください。',
            'name_kana.max' => '255字以内で入力してください。',
            'name_kana.regex' => 'カナ以外の文字は使用できません。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しい形式で入力してください。',
            'email.max' => '255字以内で入力してください。',
            'email.min' => '8文字以上の、半角英数字で入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.max' => '255字以内で入力してください。',
            'password.min' => '8文字以上の、半角英数字で入力してください。',
            'password.regex' => '使用できない文字が含まれています。',
            'password.confirmed' => 'パスワード確認が一致していません。',
        ]);

        $user = User::create([
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
