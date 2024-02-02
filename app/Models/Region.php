<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function coordinator(): BelongsTo {
        return $this->belongsTo(User::class, 'coordinator_id', 'id');
    }

    public function members() : HasMany {
        return $this->hasMany(User::class);
    }
}
