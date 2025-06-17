<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingScale extends Model
{

      protected $table = 'grading_scale';

    protected $fillable = [
        'min_score',
        'max_score',
        'letter',
        'points',
    ];

    public $timestamps = true;
}
