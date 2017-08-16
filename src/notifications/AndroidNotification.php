<?php

use Alexander\OneSignalApiLaravel\Exceptions\OneSignalException;
use Alexander\OneSignalApiLaravel\Exceptions\OneSignalRequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;

/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 16.08.17
 * Time: 11:33
 */

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

    /**
     * @return null
     * @throws OneSignalException
     * @throws OneSignalRequestException
     */
    public function sentPost()
    {
        if(!preg_match( $this->_REGEXP_URL ,$this->apiUrl)){
            throw new OneSignalException("Not valid url");
        }
        try {
            return $this->client->post($this->apiUrl, [
                'headers' => $this->headers,
                'body' => $this->getDataByJson()
            ]);
        }catch (RequestException $e){
            if ($e->hasResponse()) {
                $errors = json_decode($e->getResponse()->getBody(), true)['errors'];
                $exception = new OneSignalException($errors[0]);
                $exception->errorMessages = $errors;
                throw $exception;
            }
        }catch (TransferException $e){
            throw new OneSignalRequestException($e->getMessage());
        }
        return null;
    }
}