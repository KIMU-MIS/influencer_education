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
            'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ヶー　]+$/u'],
            'email'=> ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
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
