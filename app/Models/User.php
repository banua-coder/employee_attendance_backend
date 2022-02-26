<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Rackbeat\UIAvatars\HasAvatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
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
        'email_verified_at' => 'datetime',
    ];

    // Relationships

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
