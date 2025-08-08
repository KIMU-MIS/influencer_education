@extends('layouts.app')

@section('content')
<div class="container">
    {{-- ユーザー情報表示 --}}
    <div class="d-flex align-items-center mb-4">
<img src="{{ asset('storage/images/hana.jpeg') }}" class="rounded-circle me-3" width="100" height="100" alt="プロフィール画像">

        <div>
            <h4>{{ $user->name }}さんの授業進捗</h4>
            <p>
                現在の学年：
                <span class="badge bg-info text-dark">{{ $currentGrade->grade_name }}</span>
            </p>
        </div>
    </div>

    {{-- 学年ごとの授業進捗一覧 --}}
    <div class="row">
        @foreach ($grades as $grade)
            <div class="col-md-4 mb-4">
                <h6>
                    <span class="badge" style="background-color: #b2f0e6; color: black;">
                        {{ $grade->name }}
                    </span>
                </h6>
                <ul class="list-unstyled">
                    @if (isset($curriculumsByGrade[$grade->id]))
                        @foreach ($curriculumsByGrade[$grade->id] as $curriculum)
                            @php
                                $progress = $curriculum->progress->first();
                                $isCleared = $progress && $progress->clear_flg == 1;
                            @endphp
                            <li>
                                @if ($isCleared)
                                    <span class="text-danger">受講済</span>
                                @endif
                                {{ $curriculum->title }}
                            </li>
                        @endforeach
                    @else
                        <li class="text-muted">授業が登録されていません</li>
                    @endif
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
