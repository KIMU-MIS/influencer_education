@extends('layouts.app')
@section('title', '授業設定')

@section('content')

<style>
   .class-setting-container {
    padding: 20px;
    background-color: #f9f9f9;
}

.top-controls {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
}

.back-button {
    padding: 8px 16px;
    background-color: #87cefa;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.page-title {
    font-size: 24px;
    margin: 0;
}

.setting-form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* サムネイル表示とアップロード */
.thumbnail-preview img {
    width: 200px;
    height: auto;
    border-radius: 10px;
    margin-bottom: 10px;
    display: block;
}

.thumbnail-upload {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-left: 220px; /* サムネイルの右側 */
    margin-bottom: 20px;
}

.thumbnail-upload label {
    font-weight: bold;
    margin-bottom: 5px;
}

.curriculum-form {
    width: 100%;
    max-width: 500px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* 各フォーム項目 */
.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-left: 20px;
}

/* 登録ボタン */
.submit-button-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.submit-button {
    padding: 10px 30px;
    background-color: #4caf50;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
</style>

<div class="class-setting-container">
    <div class="top-controls">
        <a href="{{ route('class.list') }}"> 
        <button class="back-button">戻る</button>
        </a>

        <h1 class="page-title">授業設定</h1>
    </div>

    <div class="setting-form">
        <!-- サムネイル表示 -->
        @if (!empty($curriculum->thumbnail))
            <div class="thumbnail-preview">
                <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" alt="サムネイル画像">
            </div>
        @endif 
        <!-- サムネイルアップロード -->
          <div class="thumbnail-upload">
            <label for="thumbnail">サムネイル</label>
            <input type="file" name="thumbnail" id="thumbnail">
        </div>  

        <!-- エラーメッセージ表示 -->
       <div id="ajax-errors" class="error-messages" style="color: red; margin-bottom: 10px;"></div> 
        <!-- 登録フォーム -->
        <form id="curriculum-form" action="{{  isset($curriculum) ? route('curriculum.update', $curriculum->id) :route('curriculum.store') }}" method="POST" enctype="multipart/form-data" class="curriculum-form">
            @csrf
            @if (isset($curriculum))
              @method('PUT')
            @endif
          
            <div class="form-group">
                <label for="grade">学年</label>
                <select name="grade_id" required>
                   <option value="">学年を選択</option>
                  @foreach ($grades as $grade)
                   <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                  @endforeach
                    @error('grade_id')
                     <div class="error">{{ $message }}</div>
                    @enderror
                </select>
            </div>

            <div class="form-group">
                <label for="title">授業名</label>
                <input type="text" name="title" id="title" value="{{ old('title', $curriculum->title ?? '') }}">
                @error('title')
                     <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="video_url">動画URL</label>
                <input type="text" name="video_url" id="video_url" value="{{ old('video_url', $curriculum->video_url ?? '') }}">
                @error('video_url')
                     <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">授業概要</label>
                <textarea name="description" id="description" rows="6">{{ old('description', $curriculum->description ?? '') }}</textarea>
                @error('description')
                     <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check">
                <label for="is_published">常時公開</label>
                <input type="checkbox" name="alway_delivery_flg" id="alway_delivery_flg"
               {{ old('alway_delivery_flg', $curriculum->alway_delivery_flg ?? false) ? 'checked' : '' }}>
            </div>
            
            <div class="submit-button-wrapper">
                <button type="submit" class="submit-button">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function () {
    $('#curriculum-form').on('submit', function (e) {
        e.preventDefault(); // 通常の送信を止める

        const form = $(this)[0];
        const formData = new FormData(form);
        const url = $(this).attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert('授業内容を保存しました！');
                window.location.href = "{{ route('class.list') }}"; // 一覧へリダイレクト
            },
            error: function (xhr) {
              console.error("サーバーエラー内容:", xhr.responseText); // ← 追加！
              console.log("responseJSON:", xhr.responseJSON); // ← これ追加！

               const errors = xhr.responseJSON?.errors;
               let html = '';
              if (errors) {
                  for (let field in errors) {
                        errors[field].forEach(msg => {
                          html += `<p>${msg}</p>`;
                 });
                }
                $('#ajax-errors').html(html); // ページ内に表示
            } else {
            $('#ajax-errors').html('<p>予期せぬエラーが発生しました。</p>');
            }
            }
        });
    });
});
</script>