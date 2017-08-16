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

    public function set(FilterField $filterField)
    {
        array_push($this->data,$filterField->data());
        return $this;
    }

    public function addWithAnd(FilterField $filterField)
    {
        array_push($this->data, self::OPERATOR_OR);
        array_push($this->data,$filterField->data());
        return $this;
    }

    public function addWithOr(FilterField $filterField)
    {
        array_push($this->data, self::OPERATOR_AND);
        array_push($this->data,$filterField->data());
        return $this;
    }

    public function data()
    {
        return $this->data;
    }

}