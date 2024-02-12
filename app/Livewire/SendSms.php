<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use SamuelMwangiW\Africastalking\Facades\Africastalking;

class SendSms extends Component
{
    public $message, $recipients = [];
    public function render()
    {
        return view('livewire.send-sms');
    }

    public function sendSMS() {
        $responses = 0;

        foreach ($this->recipients as $recipient) {
            $response = Africastalking::sms()
                ->message($this->message)
                ->to($recipient->phone_number)
                ->bulk()
                ->enqueue()
                ->send();

            if($response->recipients[0]->status->name == 'SUCCESS') {
                $responses++;
            }
        }

        if($responses == count($this->recipients)) {
            Toaster::success('Messages sent successfully');
        }

    }
}
