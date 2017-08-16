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
        array_push($this->data,[
            'field' => 'last_session',
            'relation' => $relation,
            'hours_ago' => $hoursAgo,
        ]);
        return $this;
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
        array_push($this->data,[
            'field' => 'session_count',
            'relation' => $relation,
            'value' => $value
        ]);
        return $this;
    }

    public function sessionTime($relation, $value){
        array_push($this->data,[
           'field' => 'session_time',
           'relation' => $relation,
           'value' => $value
        ]);
        return $this;
    }

    public function amount_spent($relation, $value){
        array_push($this->data,[
            'field' => 'amount_spent',
            'relation' => $relation,
            'value' => $value
        ]);
        return $this;
    }

    public function bought_sku($relation, $key){
        array_push($this->data,[
            'field' => 'bought_sku',
            'relation' => $relation,
            'key' => $key
        ]);
        return $this;
    }

    public function tag($relation, $key, $value){
        array_push($this->data,[
            'field' => 'tag',
            'relation' => $relation,
            'key' => $key,
            'value' => $value
        ]);
        return $this;
    }

    public function language($relation, $value){
        array_push($this->data, [
            'field' => 'language',
            'relation' => $relation,
            'value' => $value
        ]);
        return $this;
    }

    public function appVersion($relation, $value){
        array_push($this->data, [
           'field' => 'app_version',
           'relation' => $relation,
           'value' => $value
        ]);
        return $this;
    }

    public function location($radius, $lat, $long){
        array_push($this->data, [
            'field' => 'location',
            'radius' => $radius,
            'lat' => $lat,
            'long' => $long
        ]);
        return $this;
    }

    public function email($value){
        array_push($this->data, [
            'field' => 'email',
            'value' => $value
        ]);
        return $this;
    }

    public function data(){
        return $this->data;
    }
}