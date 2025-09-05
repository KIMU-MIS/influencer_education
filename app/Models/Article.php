<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',      // お知らせタイトル
        'content',    // お知らせ本文
        'published_at', // 公開日
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}

