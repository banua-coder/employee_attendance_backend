<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    /**
     * Get the regency that owns the District.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    /**
     * Get all of the vilages for the District.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vilages(): HasMany
    {
        return $this->hasMany(Village::class);
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
