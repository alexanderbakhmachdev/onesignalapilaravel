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

    /**
     * @param $config
     * @return $this
     * Special configuration data to configure android notification
     */
    public function withConfig($config)
    {
        $this->apiUrl = $config['api_url'];
        $this->restApiKey = $config['rest_api_key'];
        $this->oneSignalAppId = $config['rest_signal_api_id'];
        $this->headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => 'Basic' . ' ' . $this->restApiKey
        ];
        $this->data['app_id'] = $this->oneSignalAppId;
        return $this;
    }

}