<?php
namespace Bellal\Services\Pubnub\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Pubnub
 *
 * @package Bellal\Services\Pubnub\Support\Facades
 */
class Pubnub extends Facade
{
    /**
     * Get the registered name of the component
     *
     * @static
     * @access protected
     * @return string
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'bellal.services.pubnub';
    }
}