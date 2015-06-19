<?php

namespace Concat\Cache\Adapter;

use Doctrine\Common\Cache\CacheProvider as Doctrine;
use Illuminate\Contracts\Cache\Store as Illuminate;
use Stash\Interfaces\DriverInterface as Stash;
use Concat\Cache\CacheInterface;
use InvalidArgumentException;

/**
 * Procuces an appropriate adapter for a given cache driver.
 */
class AdapterFactory
{
    /**
     * Returns the appropriate adapter for a given cache driver.
     *
     * @param object $cache The instantiated cache driver.
     *
     * @return CacheInterface
     *
     * @throws InvalidArgumentException
     */
    public static function get($cache)
    {
        if ($cache instanceof CacheInterface) {
            return $cache;
        }

        if ($cache instanceof Doctrine) {
            return new DoctrineAdapter($cache);
        }

        if ($cache instanceof Illuminate) {
            return new IlluminateAdapter($cache);
        }

        if ($cache instanceof Stash) {
            return new StashAdapter($cache);
        }

        throw new InvalidArgumentException(
            "Unsupported cache instance of type " . get_class($cache)
        );
    }
}
