<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceType extends Model
{
    use HasFactory;

    protected $guarded = [];

    const CHECK_IN = 1;
    const REST = 2;
    const FINISH_REST = 3;
    const CHECK_OUT = 4;

    // Relationships

    /**
     * Get all of the attendanceCodes for the AttendanceType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendanceCodes(): HasMany
    {
        return $this->hasMany(AttendanceCode::class);
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
