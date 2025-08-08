<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CurriculumProgress;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';


    public function progresses()
    {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id');
    }


    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
