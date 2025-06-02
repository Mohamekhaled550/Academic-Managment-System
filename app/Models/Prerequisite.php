<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prerequisite extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'prerequisite_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function prerequisiteCourse()
    {
        return $this->belongsTo(Course::class, 'prerequisite_id');
    }
}
