<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $table = 'delivery_times';

    protected $fillable = [
        'curriculums_id',
        'delivery_from',
        'delivery_to',
    ];

    protected $dates = [
        'delivery_from',
        'delivery_to',
    ];

    /**
     * カリキュラムとの逆リレーション（多対1）
     */
    public function curriculum(): BelongsTo{
        return $this->belongsTo(Curriculum::class);
    }

    /**
     * 配信時間の保存処理
     *
     * @param int $id カリキュラムID
     * @param array $froms 配信開始日時の配列
     * @param array $tos 配信終了日時の配列
     */
    public static function saveForCurriculum($id, $froms, $tos){
        // 既存の配信時間を削除
      self::where('curriculums_id', $id)->delete();

      foreach ($froms as $index => $from) {
        self::create([
            'curriculums_id' => $id,
            'delivery_from' => $from,
            'delivery_to'   => $tos[$index],
        ]);
      }
   }
}
