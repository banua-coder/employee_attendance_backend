<?php

namespace App\Models\Pivot;

use App\Models\User;
use App\Models\Education;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationUser extends Pivot
{

    protected $guarded = [];

    protected $table = 'education_user';

    // Relationships

    /**
     * Get the user that owns the EducationUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the education that owns the EducationUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function education(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
