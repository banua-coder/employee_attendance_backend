<?php

namespace App\Models;

use App\Models\User;
use App\Models\WorkScheme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWorkScheme extends Model
{
    protected $guarded = [];

    // Relationships
    /**
     * Get the user that owns the UserWorkScheme.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the workScheme that owns the UserWorkScheme.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workSchemeType(): BelongsTo
    {
        return $this->belongsTo(WorkScheme::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
