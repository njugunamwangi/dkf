<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use SamuelMwangiW\Africastalking\Facades\Africastalking;

class SendSms extends Component
{
    public $message, $recipients = [];
    public function render()
    {
        return view('livewire.send-sms');
    }

    public function sendSMS() {
        $responses = [];

        foreach ($this->recipients as $recipient) {
            $response = Africastalking::sms()
                ->message($this->message)
                ->to($recipient->phone_number)
                ->bulk()
                ->enqueue()
                ->send();
        }

    }
}
