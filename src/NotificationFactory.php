<?php

namespace Alexander\OneSignalApiLaravel;


use Alexander\OneSignalApiLaravel\Exceptions\OneSignalException;
use Alexander\OneSignalApiLaravel\Exceptions\OneSignalRequestException;
use AndroidNotification;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use IosNotification;
use Notification;
use WebNotification;


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