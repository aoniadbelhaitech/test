<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends User
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function period()
    {
        return $this->hasMany(Period::class);
    }
}
