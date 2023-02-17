<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonSchedule extends Model
{
    use HasFactory;

    protected $table = 'lesson_schedules';

    protected $guarded = [];

    /**
     * Get the school year that owns the lesson schedule.
     */
    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    /**
     * Get the class room that owns the lesson schedule.
     */
    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    /**
     * Get the teacher that owns the lesson schedule.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the subjects that owns the lesson schedule.
     */
    public function subjects()
    {
        return $this->belongsTo(Subjects::class);
    }

    /**
     * Get the day that owns the lesson schedule.
     */
    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
