<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Grades;
use App\Models\Course;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'cnic', 'number', 'course_id', 'grades_id',
    ];

    // ONE-ONE (STUDENT-GRADES)
    public function grades()
    {
        return $this->hasOne(Grades::class);
    }

    // ONE-MANY (STUDENT-COURSES)
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
