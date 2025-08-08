<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['grade_name'];

    // ユーザーとのリレーション（1対多）
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // カリキュラムとのリレーション（1対多）
    public function curriculums()
    {
        return $this->hasMany(Curriculum::class);
    }
}
