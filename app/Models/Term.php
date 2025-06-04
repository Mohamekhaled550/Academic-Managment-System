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

    public function offerings()
    {
        return $this->hasMany(CourseOffering::class);
    }



}

