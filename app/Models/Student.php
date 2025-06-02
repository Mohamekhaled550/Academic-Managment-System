<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'national_id', 'gpa', 'total_credits','level'];
    protected $appends = ['calculated_level'];

    // علاقة بالمواد المسجلة
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }


    public function registeredCourses()
{
    return $this->hasManyThrough(
        \App\Models\Course::class,
        \App\Models\Registration::class,
        'student_id', // Foreign key on Registration table
        'id',         // Foreign key on Course table
        'id',         // Local key on Student table
        'course_id'   // Local key on Registration table
    );
}


   //علاقة بالقسم
    public function department()
{
    return $this->belongsTo(Department::class);
}

    // تحديد المواد التي اجتازها الطالب
    public function passedCourses()
    {
        return $this->registrations()
            ->whereNotNull('grade')
            ->where('grade', '>=', 50)
            ->pluck('course_id');    }


    //  الكورسات التي رسب فيها ربنا ما يكتبها علي حد
    public function failedCourses()
    {
        return $this->registrations()
            ->whereNotNull('grade')
            ->where('grade', '<', 50)
            ->pluck('course_id');
    }

  public static function boot()
    {
        parent::boot();

         static::saving(function ($student) {
            // إعادة حساب عدد الساعات والمستوى عند كل عملية حفظ
            $student->total_credits = Course::whereIn('id', $student->passedCourses())->sum('credit_hours');
            $student->level = max(1, ceil($student->total_credits / 36));
        });
    }

    // عدد الساعات التي اجتازها فعليًا (total_credits المحسوبة)
    public function getTotalCreditsAttribute()
    {
        return Course::whereIn('id', $this->passedCourses())->sum('credit_hours');
    }



}
