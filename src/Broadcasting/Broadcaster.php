<?php
namespace Bellal\Services\Pubnub\Broadcasting;

use Illuminate\Contracts\Broadcasting\Broadcaster as IlluminateContractBroadcaster;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Pubnub\Pubnub;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
/**
 * Class Broadcaster
 *
 * @package Nodes\Services\Pubnub\Broadcasting
 */
class Broadcaster implements IlluminateContractBroadcaster
{
    /**
     * Pubnub SDK instance
     *
     * @var \Pubnub\Pubnub
     */
    protected $pubnub;

    /**
     * Broadcaster constructor
     *
     * @access public
     * @param  \Pubnub\Pubnub $pubnub
     */
    public function __construct(Pubnub $pubnub)
    {
        $this->pubnub = $pubnub;
    }

    public function auth($request)
    {
        if (Str::startsWith($request->channel_name, ['private-', 'presence-']) &&
            ! $request->user()) {
            throw new AccessDeniedHttpException;
        }

        $channelName = Str::startsWith($request->channel_name, 'private-')
                            ? Str::replaceFirst('private-', '', $request->channel_name)
                            : Str::replaceFirst('presence-', '', $request->channel_name);

        return parent::verifyUserCanAccessChannel(
            $request, $channelName
        );
    }

    /**
     * Return the valid authentication response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $result
     * @return mixed
     */
    public function validAuthenticationResponse($request, $result)
    {
        return;
    }

    /**
     * Broadcast the given event
     *
     * @access public
     * @param  array  $channels
     * @param  string $event
     * @param  array  $payload
     * @return void
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
        foreach ($channels as $channel) {
            $this->pubnub->publish()
                ->channel($channel)
                ->message(['data' => $payload])
                ->sync();
        }
    }
}