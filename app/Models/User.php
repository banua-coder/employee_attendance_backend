<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Rackbeat\UIAvatars\HasAvatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    // Methods
    public function getAvatar($size = 256)
    {
        return $this->getGravatar($this->email, $size);
    }

    // Scopes

    // Accessors
    public function getAvatarAttribute($value)
    {
        if (is_null($value)) {
            return $this->getAvatar();
        }

        return asset(Storage::url($value));
    }

    // Mutators
}
