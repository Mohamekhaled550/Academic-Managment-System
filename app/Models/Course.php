<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code', 'name', 'credit_hours', 'level', 'semester', 'department_id', 'course_group_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

   public function courseGroup()
{
    return $this->belongsTo(CourseGroup::class);
}

    public function prerequisites()
    {
        return $this->belongsToMany(Course::class, 'prerequisites', 'course_id', 'prerequisite_id');
    }

     public function isPrerequisiteFor()
    {
        return $this->hasMany(Prerequisite::class, 'prerequisite_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function offerings()
    {
        return $this->hasMany(CourseOffering::class);
    }
}





