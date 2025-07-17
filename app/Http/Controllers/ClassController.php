<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Http\Requests\CurriculumRequest;
use App\Http\Requests\CurriculumDeliveryRequest;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\Grade;

class ClassController extends Controller
{
   public function index(Request $request)
{
    $selectedGradeName = $request->input('grade');

    $query = Curriculum::with(['deliveryTimes', 'grade']);

    // 学年が選択されていた場合に絞り込み
    if ($selectedGradeName) {
        $query->whereHas('grade', function ($q) use ($selectedGradeName) {
            $q->where('name', $selectedGradeName);
        });
    }

    $curriculums = $query->get();

     $grades = Grade::all();

    return view('list_of_classes', [
        'curriculums' => $curriculums,
        'selectedGrade' => $selectedGradeName,
         'grades' => $grades,
    ]);
}

    public function settingForm()
    {
        return view('class_setting');
    }

    public function classSettingForm()
{
    $grades = Grade::all(); // プルダウン用
    return view('class_setting', compact('grades'));
}
    
    public function deliveryTimeForm($id)
   {
    $curriculum = Curriculum::findOrFail($id);
    return view('delivery_times_setting', compact('curriculum'));
}

//授業登録処理
public function store(CurriculumRequest $request)
{
  
    

    // 画像があれば保存
    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    // 保存処理
    $curriculum = new Curriculum();
    $curriculum->title = $request->title;
    $curriculum->grade_id = $request->grade_id;
    $curriculum->video_url = $request->video_url;
    $curriculum->description = $request->description;
    $curriculum->alway_delivery_flg = $request->boolean('alway_delivery_flg');
    $curriculum->thumbnail = $thumbnailPath;
    $curriculum->save();

    return redirect()
    ->route('class.list')
    ->with('success', '授業が登録されました')
    ->with('show_grade_id', 1); // 小学1年生を初期表示
}   

// 授業編集フォーム
public function edit($id)
{
    $curriculum = Curriculum::findOrFail($id);
    $grades = Grade::all();

    return view('class_setting', compact('curriculum', 'grades'));
}

// 授業更新処理
public function update(CurriculumRequest $request, $id)
{
    

    $curriculum = Curriculum::findOrFail($id);

    // サムネイルがアップロードされた場合
    if ($request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('thumbnails', 'public');
        $curriculum->thumbnail = $path;
    }

    // その他の項目を更新
    $curriculum->title = $request->input('title');
    $curriculum->video_url = $request->input('video_url');
    $curriculum->description = $request->input('description');
    $curriculum->grade_id = $request->input('grade_id');
    $curriculum->alway_delivery_flg = $request->boolean('alway_delivery_flg');
    $curriculum->save();

    return redirect()->route('class.list')->with('success', '授業情報を更新しました');
}

// 授業設定フォームAjax 用
public function fetch(Request $request)
{
    $gradeId = $request->input('grade_id');

    if (!$gradeId) {
        return response()->json(['html' => '']);
    }

    $curriculums = Curriculum::where('grade_id', $gradeId)->get();

    $html = view('partials.curriculum_list', compact('curriculums'))->render();

    return response()->json(['html' => $html]);
}



// 配信時間の登録処理
public function storeDelivery(CurriculumDeliveryRequest $request, $id)
{
    

    // 一度すべて削除してから再登録（上書き更新のつもりで）
    DeliveryTime::where('curriculums_id', $id)->delete();

    // 配信時間の保存（複数行）
    foreach ($request->delivery_from as $index => $from) {
        $delivery = DeliveryTime::create([
            'curriculums_id' => $id,
            'delivery_from' => $from,
            'delivery_to'   => $request->delivery_to[$index],
        ]);

       // 確認のため追加
       \Log::info('保存された配信時間:', $delivery->toArray());  
    }

    return redirect()->route('class.list')->with('success', '配信時間が登録されました');

    if (!$request->has('delivery_from') || !$request->has('delivery_to')) {
    return back()->withErrors(['error' => '配信日時を1件以上入力してください']);
}
}
}



