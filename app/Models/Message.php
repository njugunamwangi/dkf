<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'recipients' => 'json',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function region(): BelongsTo {
        return $this->belongsTo(Region::class);
    }
}
