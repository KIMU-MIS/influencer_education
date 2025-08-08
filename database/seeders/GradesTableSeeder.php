<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GradesTableSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            '小学1年生',
            '小学2年生',
            '小学3年生',
            '小学4年生',
            '小学5年生',
            '小学6年生',
            '中学1年生',
            '中学2年生',
            '中学3年生',
            '高校1年生',
            '高校2年生',
            '高校3年生',
        ];

        foreach ($grades as $grade) {
            DB::table('grades')->insert([
                'grade_name' => $grade,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
