<?php

namespace App\Models;

use App\Models\User;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShiftUser extends Model
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
    public function shiftType(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
