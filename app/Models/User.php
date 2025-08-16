<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\UploadedFile;           // ← 追加
use Illuminate\Support\Facades\Hash;        // ← 追加

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'name_kana',        // ← 追加しておくと安全
        'email',
        'password',
        'grade_id',
        'profile_image',    // ← 追加しておくと安全
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Laravel 10 互換ならプロパティでOK
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

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

    public function updateProfile(array $data, ?UploadedFile $image = null): void
    {
        $this->name      = $data['name'];
        $this->name_kana = $data['name_kana'];
        $this->email     = $data['email'];

        if ($image) {
            $path = $image->store('images', 'public');
            $this->profile_image = basename($path);
        }

        $this->save();
    }

    public function changePassword(string $newPassword): void
    {
        $this->password = Hash::make($newPassword);
        $this->save();
    }
}
