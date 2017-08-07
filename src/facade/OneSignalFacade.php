<?php

namespace Alexander\OneSignalApiLaravel\Facade;

use Illuminate\Support\Facades\Facade;

class OneSignalFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'notification'; }
}