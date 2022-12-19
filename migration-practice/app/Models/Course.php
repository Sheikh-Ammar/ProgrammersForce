<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'cname',
    ];

    // MANY-ONE (COURSES-STUDENT)
    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
