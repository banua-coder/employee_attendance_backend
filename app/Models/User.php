<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Pivot\ShiftUser;
use App\Models\Enums\GenderEnum;
use Laravel\Sanctum\HasApiTokens;
use Rackbeat\UIAvatars\HasAvatar;
use App\Models\Pivot\EducationUser;
use App\Models\Pivot\UserWorkScheme;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasAvatar;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'two_factor_confirmed_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    // Relationships

    /**
     * Get the religion that owns the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    /**
     * Get the gender that owns the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function locationAddress()
    {
        return $this->morphOne(LocationAddress::class, 'location_addressable');
    }

    /**
     * The education that belong to the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function education(): BelongsToMany
    {
        return $this->belongsToMany(Education::class, EducationUser::class, 'user_id', 'education_id')
            ->withPivot('instition_name', 'graduation_date', 'prefix_title', 'suffix_title', 'grade_point_average');
    }

    public function lastEducation(): HasONe
    {
        return $this->hasOne(Education::class)->latestOfMany('education_id');
    }

    /**
     * Get all of the attendances for the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * The shifts that belong to the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shifts(): BelongsToMany
    {
        return $this->belongsToMany(Shift::class, ShiftUser::class, 'user_id', 'shift_id');
    }

    /**
     * Get the shift associated with the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shift(): HasOne
    {
        return $this->hasOne(Shift::class)->latestOfMany();
    }

    /**
     * The workSchemes that belong to the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workSchemes(): BelongsToMany
    {
        return $this->belongsToMany(WorkScheme::class, UserWorkScheme::class, 'user_id', 'work_scheme_id');
    }

    /**
     * Get the workScheme associated with the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function workScheme(): HasOne
    {
        return $this->hasOne(WorkScheme::class)->latestOfMany();
    }

    // Methods
    public function getAvatar($size = 256)
    {
        return $this->getGravatar($this->email, $size);
    }

    // Scopes
    public function scopeIsActive($query, bool $isActive = true)
    {
        return $isActive
            ? $query->whereNull('suspended_at')
            : $query->whereNotNull('suspended_at');
    }

    public function scopeGender($query, $gender)
    {
        return $query->whereRelation('gender', 'name', '=', $gender)
            ->orWhereRelation('gender', 'id', '=', $gender);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('suspended_at');
    }

    public function scopeMale($query)
    {
        return $query->whereRelation('gender', 'id', '=', GenderEnum::MALE);
    }

    public function scopeFemale($query)
    {
        return $query->whereRelation('gender', 'id', '=', GenderEnum::FEMALE);
    }

    // Accessors
    public function getAvatarAttribute($value)
    {
        if (is_null($value)) {
            return $this->getAvatar();
        }

        if (! \filter_var($value, \FILTER_VALIDATE_URL)) {
            return asset(Storage::url($value));
        }

        return $value;
    }

    public function getNameAttribute($value)
    {

        if ($this->relationLoaded('education')) {
            $education = $this->education;

            if (count($education) <= 0) {
                return $value;
            }

            foreach ($education as $item) {
                if ($item->prefix_title != null) {
                    $value = Str::start($value, $item->prefix_title.' ');
                } elseif ($item->suffix_title !== null) {
                    $value .= ', ';

                    $programme = explode('.', $item->suffix_title)[1];
                    $previousTitle = explode(',', $value);
                    if (count($previousTitle) > 1) {
                        $previousTitle = $previousTitle[1];
                    } else {
                        $previousTitle = '';
                    }

                    if (Str::of($previousTitle)->contains($programme)) {
                        $name = explode(',', $value);
                        $value = $name[0].', ';
                    }
                    $value = Str::finish($value, $item->suffix_title);
                }
            }
        }

        return $value;
    }
    // Mutators
}
