<?php

namespace App\Models;

use App\Models\PenaltyUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penalty extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    /**
     * Get all of the penalties for the Penalty
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penalties(): HasMany
    {
        return $this->hasMany(PenaltyUser::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
