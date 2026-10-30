<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseRegistration extends Model
{
    protected $fillable = ['student_id', 'course_id', 'academic_year', 'semester'];

    // A registration belongs to a Student
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // A registration belongs to a Course
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}