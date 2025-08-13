@extends('layouts.app')

@section('content')

<div class="back-link3" style="margin: 10px 0 0 16px;">
    <a href="{{ route('user.curriculum.list') }}">← 戻る</a>
</div>

<div class="profile-header3">
    <div class="profile-image3">
        @php
            $imgPath = $user->profile_image
                ? asset('storage/images/'.$user->profile_image)
                : asset('img/hana.jpeg');
        @endphp
        <img src="{{ $imgPath }}" alt="プロフィール画像">
    </div>
    <div class="user-info3">
        <div class="progress-title3">{{ $user->name }} さんの授業進捗</div>
        <div class="current-grade3">
            現在の学年：
            <span class="grade-label3">{{ $currentGrade?->grade_name ?? '未設定' }}</span>
        </div>
    </div>
</div>

<div class="grades-container3">
    @foreach($grades as $grade)
        <div class="grade-section3">
            <div class="grade-label3">{{ $grade->grade_name }}</div>
            <ul class="curriculum-list3">
                @if(isset($curriculumsByGrade[$grade->id]) && count($curriculumsByGrade[$grade->id]) > 0)
                    @foreach($curriculumsByGrade[$grade->id] as $curriculum)
                    @php
                $cleared = $curriculum->progresses->contains(fn($p) => (int)$p->clear_flg === 1);
                    @endphp
                    <li>
                    <span class="completed-badge {{ $cleared ? '' : 'is-hidden' }}">受講済</span>
                    <span class="curriculum-title">{{ $curriculum->title }}</span>
                    </li>
                    @endforeach
                @else
                    <li>授業が登録されていません</li>
                @endif
            </ul>
        </div>
    @endforeach
</div>

@endsection
