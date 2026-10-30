<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = ['course_code', 'title', 'description', 'credits', 'lecturer_id'];

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }

   public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_registrations')
                    ->withPivot('id', 'academic_year', 'semester')
                    ->withTimestamps();
    }
}