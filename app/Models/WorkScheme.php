<?php

namespace App\Models;

use App\Models\Pivot\UserWorkScheme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WorkScheme extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    /**
     * The users that belong to the WorkScheme.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, UserWorkScheme::class, 'work_scheme_id', 'user_id');
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
