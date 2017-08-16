<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 16.08.17
 * Time: 14:59
 */

namespace Alexander\OneSignalApiLaravel\Filter;


class FilterField
{
    private $data;

    private function __construct()
    {
        $this->data = array();
    }

    public static function createInstance(){
        return new FilterField();
    }

    public function lastSession($relation, $hoursAgo){
        return json_encode([
            'field' => 'last_session',
            'relation' => $relation,
            'hours_ago' => $hoursAgo,
        ]);

    }

    public function firstSession($relation, $hoursAgo){
        array_push($this->data,[
            'field' => 'first_session',
            'relation' => $relation,
            'hours_ago' => $hoursAgo,
        ]);
        return $this;
    }

    public function sessionCount($relation, $value){
        return [
            'field' => 'session_count',
            'relation' => $relation,
            'value' => $value
        ];
    }

    public function sessionTime($relation, $value){
       return [
           'field' => 'session_time',
           'relation' => $relation,
           'value' => $value
        ];
    }

    public function amount_spent($relation, $value){
        return [
            'field' => 'amount_spent',
            'relation' => $relation,
            'value' => $value
        ];
    }

    public function bought_sku($relation, $key){
        return [
            'field' => 'bought_sku',
            'relation' => $relation,
            'key' => $key
        ];
    }

    public function tag($relation, $key, $value){
        return [
            'field' => 'tag',
            'relation' => $relation,
            'key' => $key,
            'value' => $value
        ];
    }

    public function language($relation, $value){
        return [
            'field' => 'language',
            'relation' => $relation,
            'value' => $value
        ];
    }

    public function appVersion($relation, $value){
        return [
           'field' => 'app_version',
           'relation' => $relation,
           'value' => $value
        ];
    }

    public function location($radius, $lat, $long){
        return [
            'field' => 'location',
            'radius' => $radius,
            'lat' => $lat,
            'long' => $long
        ];
    }

    public function email($value){
        return [
            'field' => 'email',
            'value' => $value
        ];
    }

    public function data(){
        return $this->data;
    }
}