<?php

namespace App\Models;

use App\Models\Pivot\ShiftUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    /**
     * The users that belong to the Shift.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, ShiftUser::class, 'shift_id', 'user_id');
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
