<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $guarded = [];

    /**
     * Get the student associated with the user.
     */
    public function grade()
    {
        return $this->hasOne(Grade::class);
    }
}
