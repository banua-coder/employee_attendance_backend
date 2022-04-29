<?php

namespace App\Models;

use App\Models\User;
use App\Models\Education;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationUser extends Model
{
    protected $guarded = [];

    protected $table = 'education_user';

    // Relationships

    /**
     * Get the user that owns the EducationUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the education that owns the EducationUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function educationType(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
