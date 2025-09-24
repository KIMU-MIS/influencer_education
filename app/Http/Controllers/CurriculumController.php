<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function progress()
    {
        // 授業進捗画面の処理
        return view('curriculum.progress');
    }
}
