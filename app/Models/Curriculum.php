<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums'; // 省略可：Laravelが自動で判断

    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'video_url',
        'grade',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * 配信日時のリレーション（1対多）
     */
    public function deliveryTimes(): HasMany
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    public function grade()
    {
    return $this->belongsTo(Grade::class);
    }
}


