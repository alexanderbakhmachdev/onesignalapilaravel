<?php

namespace Alexander\OneSignalApiLaravel;


use Alexander\OneSignalApiLaravel\Notifications\AndroidNotification;
use Alexander\OneSignalApiLaravel\Notifications\IosNotification;
use Alexander\OneSignalApiLaravel\Notifications\Notification;
use Alexander\OneSignalApiLaravel\Notifications\WebNotification;

abstract class NotificationFactory
{
    /**
     * Factory method
     * @param $type
     * @param $data
     * can take value of android, ios or web
     *
     * @return Notification
     */
    public static function getNotification($type, $data = []){
        if($type == 'android')
            return AndroidNotification::createInstance($data);
        if($type == 'web')
            return WebNotification::createInstance($data);
        if($type == 'ios')
            return IosNotification::createInstance($data);
        else
            return null;
    }
}