@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    {{-- ヘッダー直下・左端の戻る --}}
    <a href="{{ route('progress') }}" class="btn-back2">← 戻る</a>

    <div class="profile-container">
        <h2>プロフィール設定</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- プロフィール画像＋ファイル選択 --}}
            <div class="profile-image-group">
                @php
                    $imgPath = $user->profile_image
                        ? asset('storage/images/'.$user->profile_image)
                        : asset('img/hana.jpeg');  // フォールバック
                @endphp
                <img src="{{ $imgPath }}" alt="プロフィール画像" class="profile-image">

                <div class="profile-image-input-group">
                    <label for="profile_image">プロフィール画像</label>
                    <input type="file" name="profile_image" id="profile_image">
                    @error('profile_image')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- 名前（初期は空） --}}
            <div class="form-row">
                <label for="name">名前</label>
                <input type="text" name="name" id="name"
                       class="form-control"
                       value="{{ old('name') }}" placeholder="">
                @error('name') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- カナ（初期は空） --}}
            <div class="form-row">
                <label for="name_kana">カナ</label>
                <input type="text" name="name_kana" id="name_kana"
                       class="form-control"
                       value="{{ old('name_kana') }}" placeholder="">
                @error('name_kana') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- メール（初期は空） --}}
            <div class="form-row">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email"
                       class="form-control"
                       value="{{ old('email') }}" placeholder="">
                @error('email') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- パスワード変更リンク --}}
            <div class="form-row password-change-group">
                <label>パスワード</label>
                <a href="{{ route('profile.password.edit') }}" class="btn-password-change">パスワードを変更する</a>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">更新する</button>
            </div>
        </form>
    </div>
@endsection
