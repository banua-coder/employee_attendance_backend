<?php

namespace App\Models;

use App\Models\User;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGrade extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    /**
     * Get the user that owns the UserGrade
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the gradeType that owns the UserGrade
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gradeType(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
