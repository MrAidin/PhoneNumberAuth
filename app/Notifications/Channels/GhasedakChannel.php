<?php

namespace App\Notifications\Channels;
use Illuminate\Notifications\Notification;


class GhasedakChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toGhasedakSms')) {
            throw new \Exception('to ghasedak sms not found');
        }
        $data = $notification->toGhasedakSms($notifiable);
        $message = $data['text'];
        $lineNumber = "30005088";
        $receptor = "09357664802";
        $api = new \Ghasedak\GhasedakApi('81615068f67a4f04899bd33d366c61dde8885d5c539ad220143c7faaca3d5e92');
        $api->SendSimple($receptor, $message, $lineNumber);


    }
}
