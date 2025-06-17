<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['name', 'year', 'semester', 'level', 'starts_at', 'ends_at'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
 public function courseOfferings()
 {
     return $this->hasMany(CourseOffering::class);
 }

public function courses()
{
    return $this->belongsToMany(Course::class, 'course_offerings');
}



}

