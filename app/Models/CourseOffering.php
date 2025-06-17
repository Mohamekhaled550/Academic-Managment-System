<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseOffering extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'term_id', 'section', 'level', 'is_elective'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
