<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Grade;

class ProgressController extends Controller
{
    public function index()
    {

        $user = User::find(1);
        if (!$user) {
            abort(404);
        }

        $grades = Grade::with([
            'curriculums' => function ($q) use ($user) {
                $q->with(['progresses' => function ($q2) use ($user) {
                    $q2->where('users_id', $user->id);
                }]);
            },
        ])->get();

        $currentGrade = $user->grade;

        // 既存Blade互換：学年ごとのカリキュラム配列
        $curriculumsByGrade = [];
        foreach ($grades as $g) {
            $curriculumsByGrade[$g->id] = $g->curriculums;
        }

        return view('user.progress', compact('user', 'grades', 'currentGrade', 'curriculumsByGrade'));
    }
}
