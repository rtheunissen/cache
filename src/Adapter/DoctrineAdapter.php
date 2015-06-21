<?php

namespace Concat\Cache\Adapter;

use Doctrine\Common\Cache\CacheProvider;
use Concat\Cache\CacheInterface;

/**
 * Adapts a Doctrine\Common\Cache\CacheProvider to Concat\Cache\CacheInterface.
 */
class DoctrineAdapter implements CacheInterface
{
    /**
     * @var \Doctrine\Common\Cache\CacheProvider $cache
     */
    private $cache;

    /**
     * @param CacheProvider $cache
     */
    public function __construct(CacheProvider $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function store($key, $value, $ttl = 0)
    {
        return $this->cache->save($key, $value, $ttl);
    }

    /**
     * {@inheritdoc}
     */
    public function fetch($key)
    {
        if (($value = $this->cache->fetch($key)) !== false) {
            return $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function contains($key)
    {
        return $this->cache->contains($key);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        return $this->cache->delete($key);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        return $this->cache->flushAll();
    }
}
