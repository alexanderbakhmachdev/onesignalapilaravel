
## Installation

Follow the instructions to install that package

Execute that command in linux terminal

```sh
composer require alexanderdev/onesignalapilaravel dev-master
```




Then you must to add usage 

```sh
use Alexander\OneSignalApiLaravel\OneSignalNotification;
```


## Usage

This is an example of how to sent push notification via laravel controller:

```sh
$response = OneSignalNotification::createInstance()->addContent('en' , 'My message')->forActiveUsers()->sentPost();
```