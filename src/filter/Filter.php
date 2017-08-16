<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 16.08.17
 * Time: 14:54
 */

namespace Alexander\OneSignalApiLaravel\Filter;


class Filter
{
    const OPERATOR_OR = ['operator' => 'OR'];

    const OPERATOR_AND = ['operator' => 'AND'];

    private $data;

    private function __construct()
    {
        $this->data = array();
    }

    public static function createInstance(){
        return new Filter();
    }

    public function set($field)
    {
        array_push($this->data,$field);
        return $this;
    }

    public function addWithAnd($field)
    {
        array_push($this->data, self::OPERATOR_OR);
        array_push($this->data,$field);
        return $this;
    }

    public function addWithOr($field)
    {
        array_push($this->data, self::OPERATOR_AND);
        array_push($this->data,$field);
        return $this;
    }

    public function data()
    {
        return $this->data;
    }

}