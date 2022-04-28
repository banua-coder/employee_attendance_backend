<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    /**
     * Get all of the regencies for the Province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regencies(): HasMany
    {
        return $this->hasMany(Regency::class);
    }

    public function locationAddresses()
    {
        return $this->hasMany(LocationAddress::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
