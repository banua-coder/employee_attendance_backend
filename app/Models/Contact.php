<?php

namespace App\Models;

use App\Models\ContactType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships

    /**
     * Get the contactType that owns the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contactType(): BelongsTo
    {
        return $this->belongsTo(ContactType::class);
    }

    public function contactable()
    {
        return $this->morphTo();
    }

    // Scopes

    // Methods

    // Accessors

    // Mutators
}
