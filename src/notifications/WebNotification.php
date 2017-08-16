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

    //TODO: add functions that inject params suitable only for WebSites
}