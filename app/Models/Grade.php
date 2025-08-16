<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['name']; // ← name に修正

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function curriculums()
    {
        return $this->hasMany(Curriculum::class);
    }

    public function scopeWithCurriculumsAndProgressForUser($query, User $user)
    {
        return $query->with([
            'curriculums' => function ($q) use ($user) {
                $q->with(['progresses' => function ($q2) use ($user) {
                    $q2->where('users_id', $user->id);
                }]);
            },
        ]);
    }
}
