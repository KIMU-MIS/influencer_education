<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['published_date', 'title', 'content'];

    /**
     * お知らせの新規登録
     */
    public static function createArticle(array $data)
    {
        return self::create($data);
    }

    /**
     * お知らせの更新
     */
    public function updateArticle(array $data)
    {
        return $this->update($data);
    }

    /**
     * お知らせの削除
     */
    public function deleteArticle()
    {
        return $this->delete();
    }
}
