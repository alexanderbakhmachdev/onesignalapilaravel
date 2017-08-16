<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 16.08.17
 * Time: 11:34
 */

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