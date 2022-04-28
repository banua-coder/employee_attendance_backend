<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    /**
     * Get the district that owns the Village.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
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
