<?php

namespace App\Models;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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

    public function moderator(): BelongsTo {
        return $this->belongsTo(User::class, 'moderator_id', 'id');
    }

    public function members() : HasMany {
        return $this->hasMany(User::class);
    }

    public function messages() : HasMany {
        return $this->hasMany(Message::class);
    }

    public static function getForm() : array {
        return [
            TextInput::make('region')
                ->required()
                ->maxLength(255),
            Select::make('moderator_id')
                ->relationship('moderator', 'name')
                ->options(Role::find(Role::MODERATOR)->users()->pluck('name','id'))
                ->searchable()
                ->preload(),
        ];
    }
}
