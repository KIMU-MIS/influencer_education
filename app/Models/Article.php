<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['published_date', 'title', 'content'];

    protected $casts = [
        'published_date' => 'date', // Blade の ->format() 用
    ];

    public static function createArticle(array $data)
    {
        return self::create($data);
    }

    public function updateArticle(array $data)
    {
        return $this->update($data);
    }

    public function deleteArticle()
    {
        return $this->delete();
    }
}
