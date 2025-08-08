<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // 追加
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // プロフィール編集画面表示（仮ユーザー取得）
    public function index()
    {
        // ログイン機能が未実装のため、仮でID=1のユーザー取得
        $user = User::find(1);
        return view('user.profile.edit', compact('user'));
    }

    // プロフィール更新処理
    public function update(Request $request)
    {
        $user = User::find(1); // 仮ユーザー取得

        $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->input('name');
        $user->name_kana = $request->input('name_kana');
        $user->email = $request->input('email');

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('images', 'public');
            $user->profile_image = basename($path);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'プロフィールを更新しました。');
    }

    // パスワード変更画面表示
    public function editPassword()
    {
        return view('user.profile.password_edit');
    }

    // パスワード更新処理
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(1); // 仮ユーザー取得

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')->with('success', 'パスワードを変更しました。');
    }
}
