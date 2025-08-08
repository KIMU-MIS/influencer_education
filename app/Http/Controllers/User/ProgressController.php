<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;

class ProgressController extends Controller
{
    public function index()
    {
        // ★提出前の仮ログイン処理（ID=1のユーザーで固定表示）
        $user = User::find(1);

        // 現在の学年を取得
        $currentGrade = $user->grade;

        // 全学年を取得
        $grades = Grade::all();

        // 学年ごとのカリキュラム取得
        $curriculumsByGrade = [];
        foreach ($grades as $grade) {
            $curriculumsByGrade[$grade->id] = Curriculum::where('grade_id', $grade->id)->get();
        }

        return view('user.progress', compact('user', 'grades', 'currentGrade', 'curriculumsByGrade'));
    }
}
