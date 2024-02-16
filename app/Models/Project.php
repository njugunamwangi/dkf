<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function members(): BelongsToMany{
        return $this->belongsToMany(Member::class);
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class);
    }
}
