<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'published_date' => 'required|date',
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
        ];
    }

    // 日本語ラベル（任意）
    public function attributes(): array
    {
        return [
            'published_date' => '投稿日',
            'title'          => 'タイトル',
            'content'        => '本文',
        ];
    }
}
