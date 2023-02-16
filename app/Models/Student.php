<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $guarded = [];

    /**
     * Get the families for the student.
     */
    public function families()
    {
        return $this->hasMany(Family::class);
    }

    /**
     * Get the user that owns the student.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The class_rooms that belong to the student.
     */
    public function class_rooms()
    {
        return $this->belongsToMany(ClassRoom::class);
    }
}
