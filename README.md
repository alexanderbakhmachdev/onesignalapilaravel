
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

## Usage

This is an example of how to sent push notification via laravel controller:

```sh
$response = OneSignal::forActiveUsers()->addContent('en', 'It`s work')->sentPost();
```