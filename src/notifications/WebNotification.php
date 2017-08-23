<?php
namespace Alexander\OneSignalApiLaravel\Notifications;

class WebNotification extends Notification
{

    public function __construct($data)
    {

    }

    public static function createInstance($addData = [])
    {
        return new WebNotification($addData);
    }


}