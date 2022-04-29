<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Echelon extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    /**
     * Get all of the positions for the Echelon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
