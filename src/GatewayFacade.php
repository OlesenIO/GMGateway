<?php

namespace OlesenIO\GMGateway;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OlesenIO\EPay\Skeleton\SkeletonClass
 */
class GatewayFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'GMGateway';
    }
}
