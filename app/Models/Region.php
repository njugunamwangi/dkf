<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coordinator(): BelongsTo {
        return $this->belongsTo(User::class, 'coordinator_id', 'id');
    }
}
