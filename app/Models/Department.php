<?php

namespace App\Models;

use App\Models\LocationAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    public function locationAddress()
    {
        return $this->morphOne(LocationAddress::class, 'location_addressable');
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
