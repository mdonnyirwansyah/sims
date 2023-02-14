<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table = 'families';

    protected $guarded = [];

    /**
     * Get the family's address.
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
