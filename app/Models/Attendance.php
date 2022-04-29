<?php

namespace App\Models;

use App\Models\User;
use App\Models\AttendanceCode;
use App\Models\AttendanceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    /**
     * Get the user that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attendanceCode that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendanceCode(): BelongsTo
    {
        return $this->belongsTo(AttendanceCode::class);
    }

    /**
     * Get the attendanceStatus that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendanceStatus(): BelongsTo
    {
        return $this->belongsTo(AttendanceStatus::class);
    }

    // Scopes

    public function scopeToday($query, $today)
    {
        $operator = $today ? '=' : '!=';

        return $query->whereDate('created_at', $operator, today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            today()->startOfWeek(),
            today()->endOfWeek(),
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at', now()->year);
    }

    // Methods

    // Accessors
    public function getPhotoAttribute($value)
    {
        if ($value == null) {
            return $value;
        }

        if (!\filter_var($value, \FILTER_VALIDATE_URL)) {
            return asset(Storage::url($value));
        }

        return $value;
    }

    // Mutators
}
