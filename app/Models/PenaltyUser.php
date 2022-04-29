<?php

namespace App\Models;

use App\Models\User;
use App\Models\Penalty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenaltyUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    /**
     * Get the user that owns the PenaltyUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the penaltyType that owns the PenaltyUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penaltyType(): BelongsTo
    {
        return $this->belongsTo(Penalty::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
