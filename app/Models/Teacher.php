<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class teacher extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->hasMany(course::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected function teacherName(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => strtoupper($value)
        );
    }
}
