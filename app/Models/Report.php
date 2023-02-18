<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $guarded = [];

    /**
     * Get the student that owns the lesson schedule.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the class room that owns the lesson schedule.
     */
    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    /**
     * Get the grades for the student.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
