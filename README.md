
## Installation

Follow the instructions to install that package

Execute that command in linux terminal

```sh
composer require alexanderdev/onesignalapilaravel dev-master
```

Add provider

```sh
'providers' => [
        
        ...
        
        Alexander\OneSignalApiLaravel\OneSignalServiceProvider::class,
        
        ...

]
```

Add facade
```sh
'aliases' => [

        ...
        
        'OneSignal' => Alexander\OneSignalApiLaravel\Facade\OneSignalFacade::class,
        
        ...
        
```

Finally from the command line
```sh
    $ php artisan config:cache
    $ php artisan vendor:publish --tag=config
```
## Configuration
All necessary config to successfully start using this package
pasted in onesignal.php located in /config
Example of configuration
```sh
    <?php
        return [
        
            'api_url' => 'https://onesignal.com/api/v1/notifications',
            'rest_api_key' => 'MTU4NjQ0NGYtMGQ4Yy00MmQzLTk2NDUtZjVlODg2YmQxZTRm',
            'rest_signal_api_id' => 'd1b6ct9b-da0c-493b-98c0-e9d14d8b4135'
        ];
```
    
## Usage

This is an example of how to sent push notification via laravel controller:

```sh
$response = OneSignal::forActiveUsers()->addContent('en', 'It`s work')->sentPost();
```