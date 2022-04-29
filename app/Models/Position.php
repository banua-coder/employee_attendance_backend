<?php

namespace App\Models;

use App\Models\Echelon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    /**
     * Get the echelon that owns the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function echelon(): BelongsTo
    {
        return $this->belongsTo(Echelon::class);
    }
    // Scopes

    // Methods

    // Accessors

    // Mutators
}
