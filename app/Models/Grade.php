<?php

namespace App\Models;

use App\Models\UserGrade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    /**
     * Get all of the grades for the Grade
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades(): HasMany
    {
        return $this->hasMany(UserGrade::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
