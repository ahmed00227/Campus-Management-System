<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsToMany(student::class, 'student_course');
    }

    public function teacher()
    {
        return $this->belongsTo(teacher::class);
    }
}
