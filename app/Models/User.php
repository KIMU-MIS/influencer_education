<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'grade_id', // 学年IDを追加
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 学年とのリレーション
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // 授業進捗とのリレーション
    public function progresses()
    {
        return $this->hasMany(CurriculumProgress::class, 'users_id');
    }
}
