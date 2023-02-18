<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $guarded = [];

    /**
     * Get the subjects that owns the lesson schedule.
     */
    public function subjects()
    {
        return $this->belongsTo(Subjects::class);
    }
}
