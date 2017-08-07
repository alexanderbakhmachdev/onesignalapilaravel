<?php
namespace Alexander\OneSignalApiLaravel\Exceptions;
use Exception;

class OneSignalException extends Exception
{
    public $errorMessages;
}