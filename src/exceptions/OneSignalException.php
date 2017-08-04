<?php
namespace Alexander\OneSignalApiLaravel;
use Exception;

class OneSignalException extends Exception
{
    public $errorMessages;
}