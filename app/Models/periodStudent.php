<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periodStudent extends Model
{
    use HasFactory;

    protected $table = 'period_student';
    protected $fillable = [
        'student_id',
        'period_id'
    ];

}
