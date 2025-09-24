<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // プロフィール編集画面
    public function edit()
    {
        return view('profile.edit');
    }
}
