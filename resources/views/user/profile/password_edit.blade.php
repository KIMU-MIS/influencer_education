@extends('layouts.app')

@section('title', 'パスワード変更')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="profile-container2">
     <a href="{{ route('profile') }}" class="btn-back2">戻る</a>
    <h2 class="title2">パスワード変更</h2>

    @if (session('success'))
        <div class="success-msg2">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row2">
            <div class="form-group2">
                <label for="current_password">旧パスワード</label>
                <input type="password" name="current_password" id="current_password" required>
                @error('current_password')
                    <div class="error-msg2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group2">
                <label for="new_password">新パスワード</label>
                <input type="password" name="new_password" id="new_password" required>
                @error('new_password')
                    <div class="error-msg2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group2">
                <label for="new_password_confirmation">新パスワード（確認）</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
            </div>
        </div>

        <div class="form-actions2">
            <button type="submit" class="btn-submit2">登録</button>
        </div>
    </form>
</div>
@endsection
