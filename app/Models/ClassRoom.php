<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $table = 'class_rooms';

    protected $guarded = [];

    /**
     * Get the school year that owns the user.
     */
    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    /**
     * Get the teacher that owns the user.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * The students that belong to the class room.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }
}
