<?php

namespace Alexander\OneSignalApiLaravel\Notifications;

use GuzzleHttp\Client;

class AndroidNotification extends Notification
{
    /**
     * AndroidNotification constructor.
     * @param $addData
     */
    private function __construct($addData)
    {

        $this->client = new Client();
        $this->data['included_segments'] = [];
        $this->data['contents'] = [];
        $this->data['filters'] = [];
        $this->data['include_player_ids'] = array();
        array_merge($this->data, $addData);
    }

    public static function createInstance($addData = []){
        return new AndroidNotification($addData);
    }


}