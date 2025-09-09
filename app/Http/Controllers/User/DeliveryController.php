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

    /**
     * IDなしアクセス（最新配信中 or 常時公開の授業を表示）
     */
    public function index()
    {
        // モデルのメソッドで最初の授業を取得
        $lesson = DeliveryTime::getCurrentLesson();

        // サイドバー用：全授業一覧
        $curriculums = DeliveryTime::with('curriculum')->get();

        return view('user.delivery', compact('lesson', 'curriculums'));
    }

    /**
     * ID付きアクセス（指定授業を表示）
     */
    public function show($id)
    {
        $lesson = DeliveryTime::with('curriculum')->find($id);

        if (!$lesson) {
            return back()->with('error', '授業が存在しません');
        }

        $curriculums = DeliveryTime::with('curriculum')->get();

        return view('user.delivery', compact('lesson', 'curriculums'));
    }

    /**
     * 受講完了
     */
    public function complete($id)
    {
        $lesson = DeliveryTime::find($id);

        if (!$lesson) {
            return back()->with('error', '授業が存在しません');
        }

        $lesson->update([
            'status' => 'completed',
        ]);

        return back()->with('success', '受講しました');
    }
}
