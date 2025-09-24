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
        'alway_delivery_flg',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'alway_delivery_flg' => 'boolean',
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
    

    // 授業登録処理
    public static function createFromRequest($request, $thumbnailPath = null)
    {
    return self::create([
        'title' => $request->title,
        'grade_id' => $request->grade_id,
        'video_url' => $request->video_url,
        'description' => $request->description,
        'alway_delivery_flg' => $request->boolean('alway_delivery_flg'),
        'thumbnail' => $thumbnailPath,
    ]);
    }
    
    // 授業更新処理
    public function updateFromRequest($request, $thumbnailPath = null){

    // 既存のカリキュラムを更新
    $this->title = $request->title;
    $this->grade_id = $request->grade_id;
    $this->video_url = $request->video_url;
    $this->description = $request->description;
    $this->alway_delivery_flg = $request->boolean('alway_delivery_flg');

    // サムネイル画像があれば更新
    if ($thumbnailPath !== null) {
        $this->thumbnail = $thumbnailPath;
    }

    $this->save();

    return $this;
    }
    public function isAvailable()
{
    $now = now();

    // alway_delivery_flg が true なら常時配信
    if ($this->alway_delivery_flg) {
        return true;
    }

    // 配信期間を deliveryTimes リレーションから判定
    // 複数配信期間がある場合は、どれか1つでも現在時刻内なら配信可能
    foreach ($this->deliveryTimes as $dt) {
        if ($dt->start_at <= $now && $now <= $dt->end_at) {
            return true;
        }
    }

    return false;
    }
}


