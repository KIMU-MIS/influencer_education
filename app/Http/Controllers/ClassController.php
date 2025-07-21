<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CurriculumRequest;
use App\Http\Requests\CurriculumDeliveryRequest;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\Grade;

class ClassController extends Controller{
   public function index(Request $request){
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

    public function settingForm(){
        return view('class_setting');
    }

    public function classSettingForm(){
    $grades = Grade::all(); // プルダウン用
    return view('class_setting', compact('grades'));
    }
    
    public function deliveryTimeForm($id){
    $curriculum = Curriculum::findOrFail($id);
    return view('delivery_times_setting', compact('curriculum'));
   
   }

    //授業登録処理
    public function store(CurriculumRequest $request){
  
     // 画像があれば保存
      $thumbnailPath = null;
      if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
      }

     // 保存処理
        $curriculum = Curriculum::createFromRequest($request, $thumbnailPath);

      return redirect()
      ->route('class.list')
      ->with('success', '授業が登録されました')
      ->with('show_grade_id', 1); // 小学1年生を初期表示   
    }   

   // 授業編集フォーム
    public function edit($id){
      $curriculum = Curriculum::findOrFail($id);
      $grades = Grade::all();

       return view('class_setting', compact('curriculum', 'grades'));
    }

   // 授業更新処理
   public function update(CurriculumRequest $request, $id){

     // カリキュラムが存在するか確認
     $curriculum = Curriculum::findOrFail($id);

     // サムネイルがアップロードされた場合
     DB::transaction(function () use ($curriculum, $request) {
        // サムネイル画像処理
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

       // モデルに更新を任せる
        $curriculum->updateFromRequest($request, $thumbnailPath);
     });

      return redirect()->route('class.list')->with('success', '授業情報を更新しました');
   }

    // 授業設定フォームAjax 用
    public function fetch(Request $request){
      $gradeId = $request->input('grade_id');

      if (!$gradeId) {
        return response()->json(['html' => '']);
      }

      $curriculums = Curriculum::where('grade_id', $gradeId)->get();

      $html = view('partials.curriculum_list', compact('curriculums'))->render();

      return response()->json(['html' => $html]);
   }



   // 配信時間の登録処理
   public function storeDelivery(CurriculumDeliveryRequest $request, $id){
     // カリキュラムが存在するか確認
     DB::transaction(function () use ($request, $id) {
    
      DeliveryTime::saveForCurriculum($id, $request->delivery_from, $request->delivery_to);
     });
     // 成功時のリダイレクト
     return redirect()->route('class.list')->with('success', '配信時間が登録されました');
    
   }
}



