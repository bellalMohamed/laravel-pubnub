<?php
namespace Bellal\Services\Pubnub;

use Bellal\Services\Pubnub\Broadcasting\Broadcaster;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use PubNub\PNConfiguration;
use Pubnub\Pubnub;

/**
 * Class ServiceProvider
 *
 * @package Bellal\Services\Pubnub
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap the application service
     *
     * @access public
     * @return void
     */
    public function boot()
    {
        // Register publish groups
        $this->publishGroups();

        // Add PubNub to broadcast manager
        app('Illuminate\Broadcasting\BroadcastManager')->extend('pubnub', function($app) {
            return new Broadcaster($app['bellal.services.pubnub']);
        });
    }

    /**
     * Register the service provider
     *
     * @access public
     * @return void
     */
    public function register()
    {
        $this->registerPubnub();
    }

    /**
     * Register publish groups
     *
     * @access protected
     * @return void
     */
    protected function publishGroups()
    {
        // Config files
        $this->publishes([
            __DIR__ . '/../config/pubnub.php' => config_path('bellal/services/pubnub.php'),
        ], 'config');
    }

    /**
     * Register Pubnub instance
     *
     * @access proteected
     * @return void
     */
    protected function registerPubnub()
    {
        $this->app->singleton('bellal.services.pubnub', function ($app) {
            $pnConfiguration = new PNConfiguration();

            $pnConfiguration->setSubscribeKey(config('bellal.services.pubnub.credentials.subscribe_key'));
            $pnConfiguration->setPublishKey(config('bellal.services.pubnub.credentials.publish_key'));
            $pnConfiguration->setSecure(config('bellal.services.pubnub.ssl', true));

            return new PubNub($pnConfiguration);
        });
    }


    /**
     * Get the services provided by the provider
     *
     * @access public
     * @return array
     */
    public function provides()
    {
        return ['bellal.services.pubnub'];
    }
}
