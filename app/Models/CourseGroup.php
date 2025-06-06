<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}


