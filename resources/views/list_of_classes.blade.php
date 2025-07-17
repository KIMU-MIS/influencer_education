@extends('layouts.app')

@section('title', '授業一覧')

@section('content')

<style>
    /* 全体共通 */
body {
    font-family: "Helvetica", "Arial", sans-serif;
    margin: 0;
    
}


/* メインコンテンツ */
.container {
    padding: 20px;
}

/* 上部操作ボタン */
.top-controls {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
}

.page-title {
    margin: 0;
}

.back-button
 {
      border: none;
      cursor: pointer;
      background-color:rgb(255, 255, 255);
}
.new-button {
   
    background-color:rgb(64, 131, 125);
    color: white;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    padding: 6px 15px;
    cursor: pointer;
}

.selected-grade {
    margin-left: 50px;
    font-weight: bold;
}

/* 学年選択ボタン */
.grade-selector {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 30px;
}

.grade-button {
    padding: 6px 12px;
    border: 1px solid #ccc;
    background-color: white;
    border-radius: 5px;
    cursor: pointer;
}

.new-registration {
    margin-top: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
}

/* 授業カード一覧 */
.curriculum-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    align-items: stretch; 
}

.curriculum-card {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* 下部を詰める */
    height: 100%;  /* 親グリッドの高さに合わせる */
}

.thumbnail {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 5px;
    margin-bottom: 10px;
}

.curriculum-title {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}

.delivery-time {
    font-size: 14px;
    color: #555;
    margin: 5px 0 15px;
}

.grade-button.active {
    background-color: #87cefa;  /* 選択中は水色 */
    font-weight: bold;
    border: 2px solid #4682b4;
}

.content-wrapper {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 20px;
    align-items: flex-start;
}

.grade-selector {
    width: auto;
}

.curriculum-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    min-width: 0; /* ← flex縮小バグ対策 */
    justify-content: start;/* 左寄せ */
    margin-top: 5px; /* 上下位置の微調整 */
}


.card-buttons {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    gap: 1px;
    
}

.edit-button {
    flex: 1;
    padding: 8px 0;
    font-size: 14px;
    min-width: 100px;
    white-space: nowrap;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
}

.edit-button.secondary {
    background-color: #2196f3;
}
</style>

 <!-- ヘッダー -->
    <!--resources/views/layouts/app.blade.php-->

    <!-- メインコンテンツ -->
    <main class="container">
       
            <div class="button"><button class="back-button">←戻る</button></div>
            <h1 class="page-title">授業一覧</h1>
            <div class="new-registration">
                <a href="{{ route('curriculum.setting') }}" class="new-button">新規登録</a>
                <span class="selected-grade">{{ $selectedGrade ?? '未選択' }}</span>
            </div>
       <!-- 学年選択 -->
    <div class="content-wrapper">
        <div class="grade-selector">
           @foreach ($grades as $grade)
            <button class="grade-button" data-grade-id="{{ $grade->id }}">
            {{ $grade->name }}
            </button>
           @endforeach

        </div>

      <div class="curriculum-list" id="curriculum-list">
          @foreach ($curriculums as $curriculum)
         <div class="curriculum-card">
            <img src="{{ asset('storage/' . $curriculum->thumbnail) }}"  class="thumbnail">
            <h2 class="curriculum-title">{{ $curriculum->title }}</h2>

            {{-- 配信時間が複数ある前提でループ --}}
            @foreach ($curriculum->deliveryTimes as $time)
                <p class="delivery-time">
                    {{ \Carbon\Carbon::parse($time->delivery_from)->format('Y/m/d H:i') }}
                    〜
                    {{ \Carbon\Carbon::parse($time->delivery_to)->format('Y/m/d H:i') }}
                </p>
            @endforeach

            <div class="card-buttons">
                <a href="{{ route('curriculum.edit', $curriculum->id) }}" class="edit-button">授業内容編集</a>
                <a href="{{ route('delivery.edit', $curriculum->id) }}" class="edit-button secondary">配信内容編集</a>
            </div>
         </div>
          @endforeach
       </div>
     </div>  
    </main>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    // 学年ボタンがクリックされたとき
    $('.grade-button').on('click', function(e) {
        e.preventDefault();
        const gradeId = $(this).data('grade-id');

        // Ajaxリクエスト送信
        $.ajax({
            url: '{{ route("class.fetch") }}', // コントローラのルート名に合わせて変更
            method: 'GET',
            data: { grade_id: gradeId },
            success: function (response) {
                $('#curriculum-list').html(response.html); // Blade の一部を返す
            },
            error: function () {
                alert('授業の読み込みに失敗しました');
            }
        });
        // 表示されてる学年名の更新
        $('.selected-grade').text($(this).text());

        // 選択中スタイル付け替え
        $('.grade-button').removeClass('active');
        $(this).addClass('active');
    });

    // セッションで初期表示（小学1年生など）
    @if(session('show_grade_id'))
        $('.grade-button[data-grade-id="{{ session('show_grade_id') }}"]').trigger('click');
    @endif
});
</script>