
## Installation

Follow the instructions to install that package

Execute that command in linux terminal

```sh
composer require alexanderdev/onesignalapilaravel dev-master
```

then after adding 

```sh
use Alexander\OneSignalApiLaravel\OneSignalNotification;
```

use OneSignalNotification class to sent notifications

## Usage

This is an example of how to sent push notification via laravel controller:

```sh
$response = OneSignalNotification::createInstance()->addContent('en' , 'My message')->forActiveUsers()->sentPost();
```