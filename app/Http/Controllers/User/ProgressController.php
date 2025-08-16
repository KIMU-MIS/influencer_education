<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\User;

class ProgressController extends Controller
{
    public function index()
    {
        // 課題用の仮ユーザーでもOK。auth()が使えるならそちらを優先
        $user = auth()->user() ?? User::find(1);
        if (! $user) {
            abort(404);
        }

        // ★ここだけをモデルスコープに置き換え（レビュー対応 ＆ N+1回避）
        $grades = Grade::withCurriculumsAndProgressForUser($user)->get();

        // 以降は元の流れのまま
        $currentGrade = $user->grade;

        $curriculumsByGrade = [];
        foreach ($grades as $g) {
            $curriculumsByGrade[$g->id] = $g->curriculums;
        }

        return view('user.progress', compact('user', 'grades', 'currentGrade', 'curriculumsByGrade'));
    }
}
