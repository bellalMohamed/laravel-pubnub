## PubNub

Broadcast events with [PubNub](http://pubnub.com) from your application

## 📝 Introduction

Integrates the [PubNub](http://pubnub.com) service, which makes it unbelieable easy to send broadcast events from your application.

## 📦 Installation

To install this package you will need:

* Laravel 5.1+
* PHP 5.5.9+

You must then modify your `composer.json` file and run `composer update` to include the latest version of the package in your project.

Or you can run the composer require command from your terminal.

## 🔧 Setup

Setup service provider in `config/app.php`

```php
Bellal\Services\Pubnub\ServiceProvider::class
```

Setup alias in `config/app.php`

```php
'Pubnub' => Bellal\Services\Pubnub\Support\Facades\Pubnub::class
```

Publish config files

```bash
php artisan vendor:publish --provider="Bellal\Services\Pubnub\ServiceProvider"
```

If you want to overwrite any existing config files use the `--force` parameter

```bash
php artisan vendor:publish --provider="Bellal\Services\Pubnub\ServiceProvider" --force
```
## ⚙ Usage

Open the `config/broadcasing.php` file and the following array to the array of `connections`:

```php
'pubnub' => [
    'driver' => 'pubnub',
    'publish_key' => env('PUBNUB_PUBLISH_KEY'),
    'subscribe_key' => env('PUBNUB_SUBSCRIBE_KEY')
],
```

Add your [PubNub](http://pubnub.com) application credentials to your `.env` file:

```
BROADCAST_DRIVER=pubnub

PUBNUB_PUBLISH_KEY=YOUR-PUBLISH-KEY
PUBNUB_SUBSCRIBE_KEY=YOUR-SUBSCRIBE-KEY
```

That's it! All your events will now be broadcasted through [PubNub](http://pubnub.com).

## 🏆 Credits

## 📄 License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
