<?php
namespace Alexander\OneSignalApiLaravel\Notifications;

use Alexander\OneSignalApiLaravel\Exceptions\OneSignalException;
use Alexander\OneSignalApiLaravel\Exceptions\OneSignalRequestException;
use Alexander\OneSignalApiLaravel\Filter\Filter;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;

abstract class Notification
{

    protected $data;

    protected $headers;

    protected $_REGEXP_URL = '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i';

    protected $restApiKey;

    protected $oneSignalAppId;

    protected $apiUrl;

    protected $client;

    public abstract function withConfig($config);

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
        $this->data['include_player_ids'] = $usersApiId;
        return $this;
    }

    /**
     * @param $userId
     * @return $this
     * Add userId to the array og users id in notification
     */
    public function addUser($userId){
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

    public function addFilter(Filter $filter){
        $this->data['filters'] = $filter->data();
        return $this;
    }

    public function addHeadings($headings){
        $this->data['headings'] = $headings;
        return $this;
    }

    public function addHeading($language, $heading){
        $this->data['headings'][$language] = $heading;
        return $this;
    }

    public function addTemplateId($id){
        $this->data['template_id'] = $id;
        return $this;
    }

    public function addData($data){
        $this->data['data'] = $data;
        return $this;
    }

    public function addSingleData($key, $value){
        $this->data['data'][$key] = $value;
        return $this;
    }

    public function addButtons(){
        //TODO: add buttond
        return $this;
    }

    public function addAfterSend($date){
        $this->data['send_after'] = $date;
        return $this;
    }


    public function addDelayedOptionTimeZone($timeZone){
        $this->data['delayed_option']['timezone'] = $timeZone;
        return $this;
    }

    public function addDelayedOptionLastActive($lastActive){
        $this->data['delayed_option']['last_active'] = $lastActive;
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
     * @return OneSignal response
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