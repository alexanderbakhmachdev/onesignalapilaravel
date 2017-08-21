<?php

namespace Alexander\OneSignalApiLaravel;


use Alexander\OneSignalApiLaravel\Exceptions\OneSignalException;
use Alexander\OneSignalApiLaravel\Exceptions\OneSignalRequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;


class OneSignalNotification
{

    private $_REGEXP_URL = '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i';

    private $restApiKey;

    private $oneSignalAppId;

    private $apiUrl;

    protected $client;
    /**
     * @var
     * One signal notification data will sent as request body
     */
    public $data;
    /**
     * @var array
     * Headers is an array use in as http header in request
     */
    public $headers;

    /**
     * OneSignalNotification constructor.
     * @param array $addData
     * Apply basic configurations for OneSignal
     */
    private function __construct($addData)
    {

        $this->client = new Client();
        $this->data['included_segments'] = [];
        $this->data['contents'] = [];
        $this->data['filters'] = [];
        array_merge($this->data, $addData);
    }

    public static function createInstance($addData = []){
        return new OneSignalNotification($addData);
    }

    public function withConfig($config){
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
     * @return $this
     * Tell OneSignal that we want to sent notifications for all active users
     * Warning! can not be combined with addUsers method
     */
    public function forActiveUsers(){
        array_push($this->data['included_segments'],'Active Users');
        return $this;
    }

    /**
     * @return $this
     * Tell OneSignal that we want to sent notification fot all inactive users
     * Warning! can not be combined with addUsers method
     */
    public function forInactiveUsers(){
        array_push($this->data['included_segments'],'Inactive Users');
        return $this;
    }

    /**
     * @param $usersApiId
     * @return $this
     * Add an array of users api ids that we want to receive our notifications
     * Warning! can not be combined with both forActiveUsers() and forInactiveUsers methods
     */
    public function addUsers($usersApiId){
        if(!isset($this->data['include_player_ids']))
            $this->data['include_player_ids'] = array();
        $this->data['include_player_ids'] = $usersApiId;
        return $this;
    }

    /**
     * @param $userId
     * @return $this
     * Add userId to the array og users id in notification
     */
    public function addUser($userId){
        if(!isset($this->data['include_player_ids']))
            $this->data['include_player_ids'] = array();
        array_push($this->data['include_player_ids'], $userId);
        return $this;
    }

    /**
     * @param $url
     * @return $this
     * Add the url for our notification.
     */
    public function addUrl($url)
    {
        $data['url'] = $url;
        return $this;
    }

    /**
     * @param $language
     * @param $message
     * @return $this
     * Add message for our notification and its language
     */
    public function addContent($language, $message)
    {
        $this->data['contents'][$language] = $message;
        return $this;
    }

    /**
     * @param $contents
     * @return $this
     * Add messages as array
     */
    public function addContents($contents){
        $this->data['contents'] = $contents;
        return $this;
    }

    /**
     * @param $time
     * @return $this
     * Add the time when user will be receive the notification
     */
    public function addDeliveryTime($time){
        $this->data['delivery_time_of_day'] = $time;
        return $this;
    }

    /**
     * @return string
     * Get json representation of notification data
     */
    public function getDataByJson(){
        return json_encode($this->data);
    }

    /**
     * @return null|\Psr\Http\Message\ResponseInterface
     * @throws OneSignalException
     * @throws OneSignalRequestException
     */
    public function sentPost(){
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