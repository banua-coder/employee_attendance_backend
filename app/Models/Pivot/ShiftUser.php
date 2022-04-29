<?php

namespace App\Models\Pivot;

use App\Models\User;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShiftUser extends Pivot
{
    protected $guarded = [];

    // Relationships

    /**
     * Get the user that owns the ShiftUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shift that owns the ShiftUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
