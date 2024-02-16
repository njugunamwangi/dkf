<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use SamuelMwangiW\Africastalking\Facades\Africastalking;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $guarded = [];

    public function region() : BelongsTo {
        return $this->belongsTo(Region::class);
    }

    public function projects(): BelongsToMany {
        return $this->belongsToMany(Project::class);
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class);
    }

    public function routeNotificationForAfricasTalking($notification)
    {
        return $this->phone_number;
    }

    public function sendSms($message) {

        $message = strip_tags($message);

        Africastalking::sms()
            ->message($message)
            ->to($this->phone_number)
            ->bulk()
            ->enqueue()
            ->send();
    }
}
