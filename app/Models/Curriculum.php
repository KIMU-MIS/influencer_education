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
}


