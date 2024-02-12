<?php

namespace App\Observers;

use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
        $recipients = User::role(Role::ADMIN)->get();

        foreach ($recipients as $recipient) {
            Notification::make()
                ->title($message->user->name . ' sent ' . $message->region->region . ' members an sms' )
                ->success()
                ->icon('heroicon-o-chat-bubble-left-right')
                ->body('New message sent')
                ->sendToDatabase($recipient);
        }
    }

    /**
     * Handle the Message "updated" event.
     */
    public function updated(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}
