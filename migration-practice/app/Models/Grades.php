<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Grades extends Model
{
    use HasFactory;

    protected $fillable = [
        'grades',
    ];

    // ONE-ONE (GRADES-STUDENT)
    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
