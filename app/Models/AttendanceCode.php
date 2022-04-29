<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\AttendanceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    /**
     * Get the attendanceType that owns the AttendanceCode
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendanceType(): BelongsTo
    {
        return $this->belongsTo(AttendanceType::class);
    }

    /**
     * Get all of the attendances for the AttendanceCode
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }
    // Methods

    // Accessors

    // Mutators
}
