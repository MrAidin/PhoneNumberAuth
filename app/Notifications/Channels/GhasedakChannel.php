<?php

namespace App\Notifications\Channels;

use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;
use Illuminate\Notifications\Notification;
use function PHPUnit\Framework\throwException;

class GhasedakChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toGhasedakSms')) {
            throw new \Exception('to ghasedak sms not found');
        }
        $data = $notification->toGhasedakSms($notifiable);
        $message = $data['text'];
        $receptor = $data['phoneNumber'];
        $api_key = config('services.ghasedak.api_key');
        try {
            $lineNumber = "30005088";
            $api = new \Ghasedak\GhasedakApi($api_key);
            $api->SendSimple($receptor, $message, $lineNumber);
        } catch (ApiException $e) {
            throw $e;
        } catch (HttpException $e) {
            throw $e;
        }

    }
}




