<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UpdateProfileRequest;
use App\Http\Requests\User\Profile\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // プロフィール編集画面表示（仮ユーザー取得のまま）
    public function index()
    {
        $user = User::find(1);
        if (! $user) {
            abort(404);
        }
        return view('user.profile.edit', compact('user'));
    }

    // プロフィール更新処理（FormRequest + モデルメソッド + トランザクション）
    public function update(UpdateProfileRequest $request)
    {
        $user = User::find(1);
        if (! $user) {
            abort(404);
        }

        DB::transaction(function () use ($user, $request) {
            // Userモデルに実装した updateProfile() を利用
            $user->updateProfile($request->validated(), $request->file('profile_image'));
        });

        return redirect()->route('profile')->with('success', 'プロフィールを更新しました。');
    }

    // パスワード変更画面表示
    public function editPassword()
    {
        return view('user.profile.password_edit');
    }

    // パスワード更新処理（FormRequest + モデルメソッド + トランザクション）
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = User::find(1);
        if (! $user) {
            abort(404);
        }

        // 現在パスワード確認
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません']);
        }

        DB::transaction(function () use ($user, $request) {
            // Userモデルに実装した changePassword() を利用
            $user->changePassword($request->new_password);
        });

        return redirect()->route('profile')->with('success', 'パスワードを変更しました。');
    }
}
