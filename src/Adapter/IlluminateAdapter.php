<?php

namespace Concat\Cache\Adapter;

use Illuminate\Contracts\Cache\Store;
use Concat\Cache\CacheInterface;

/**
 * Adapts an Illuminate\Contracts\Cache\Store to Concat\Cache\CacheInterface.
 */
class IlluminateAdapter implements CacheInterface
{
    /**
     * @param Store $cache
     */
    public function __construct(Store $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function store($key, $value, $ttl = 0)
    {
        $this->cache->put($key, $value, floatval($ttl) / 60);

        // Return false if the store was unsuccessful
        return $this->contains($key);
    }

    /**
     * {@inheritdoc}
     */
    public function fetch($key)
    {
        if (($value = $this->cache->get($key)) !== false) {
            return $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function contains($key)
    {
        return $this->cache->get($key) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        if ($this->cache->forget($key) === false) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->cache->flush();

        // Impossible to determine if the flush was successful.
    }
}
