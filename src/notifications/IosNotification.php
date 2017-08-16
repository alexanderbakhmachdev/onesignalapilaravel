<?php
namespace Alexander\OneSignalApiLaravel\Notifications;

class IosNotification extends Notification
{
    public function __construct($data)
    {

    }

    public static function createInstance($addData = [])
    {
        return new IosNotification($addData);
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