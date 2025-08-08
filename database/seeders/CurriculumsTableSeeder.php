<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CurriculumsTableSeeder extends Seeder
{
    public function run(): void
    {
        // 学年ごとに5つの授業タイトルを登録（grade_id 1〜12）
        for ($gradeId = 1; $gradeId <= 12; $gradeId++) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table('curriculums')->insert([
                    'grade_id' => $gradeId,
                    'title' => '授業タイトル' . $i,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
