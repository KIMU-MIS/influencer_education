@extends('admin.layouts.app')

@section('content')

    {{-- 戻るリンク（admin-container5の外で上部左寄せに） --}}
    <div class="back-link-area5">
        <a href="{{ route('admin.article.index') }}" class="back-link5">← 戻る</a>
    </div>

    <div class="admin-container5">

        {{-- タイトル --}}
        <h1 class="admin-title5">お知らせ一覧</h1>

        {{-- 新規登録ボタン --}}
        <div class="button-area5">
            <a href="{{ route('admin.article.create') }}" class="custom-button5 new-button5">新規登録</a>
        </div>

        {{-- 一覧テーブル --}}
        <table class="notice-table5">
            <thead>
                <tr>
                    <th>投稿日時</th>
                    <th>タイトル</th>
                    <th>内容</th>
                    <th class="action-buttons5">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($article->published_date)->format('Y/m/d') }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->content }}</td>
                        <td class="action-buttons5">
                            <a href="{{ route('admin.article.edit', $article->id) }}" class="custom-button5 edit-button5">変更</a>
                            <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="custom-button5 delete-button5" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($articles->isEmpty())
                    <tr>
                        <td colspan="4">お知らせがありません。</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
