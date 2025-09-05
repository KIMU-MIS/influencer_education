<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;

class DeliveryController extends Controller
{
    // ログイン必須
    public function __construct()
    {
        $this->middleware('auth');
    }

    // IDなしアクセス（最新配信中の授業を表示）
    public function index()
    {
        $lesson = DeliveryTime::where('delivery_from', '<=', now())
            ->where('delivery_to', '>=', now())
            ->with('curriculum')
            ->first(); // 最初の配信中授業

        $curriculums = DeliveryTime::with('curriculum')->get(); // 全授業一覧（サイドバー用）

        return view('user.delivery', compact('lesson', 'curriculums'));
    }

    // ID付きアクセス（指定授業を表示）
    public function show($id)
    {
        $lesson = DeliveryTime::with('curriculum')->find($id);

        if (!$lesson) {
            return back()->with('error', '授業が存在しません');
        }

        $curriculums = DeliveryTime::with('curriculum')->get();

        return view('user.delivery', compact('lesson', 'curriculums'));
    }

    // 受講完了
    public function complete($id)
    {
        $lesson = DeliveryTime::find($id);

        if (!$lesson) {
            return back()->with('error', '授業が存在しません');
        }

        // ここで進捗更新などの処理を追加
        return back()->with('success', '受講しました');
    }
}
