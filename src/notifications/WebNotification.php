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

    public function withConfig($config)
    {
        // TODO: Implement withConfig() method.
    }

    public function sentPost()
    {
        // TODO: Implement sentPost() method.
    }
}