<?php

namespace Concat\Cache\Adapter;

use Stash\Interfaces\DriverInterface;
use Concat\Cache\CacheInterface;

/**
 * Adapts a Stash\Interfaces\DriverInterface to Concat\Cache\CacheInterface.
 */
class StashAdapter implements CacheInterface
{
    /**
     * @var string Used when converting string keys to array keys.
     */
    private $delimiter;

    /**
     * @param DriverInterface $cache
     * @param string $delimiter Used when converting string keys to array keys.
     */
    public function __construct(DriverInterface $cache, $delimiter = "::")
    {
        $this->cache = $cache;
        $this->delimiter = $delimiter;
    }

    /**
     * Converts a string key to an array key.
     *
     * @param string $key
     */
    private function createKeyArray($key)
    {
        return explode($this->delimiter, $key);
    }

    /**
     * Sets the delimiter to use when converting string keys to array keys.
     *
     * @param string $delimiter
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * {@inheritdoc}
     */
    public function store($key, $value, $ttl = 0)
    {
        $key = $this->createKeyArray($key);
        $ttl = time() + $ttl;

        if ($this->cache->storeData($key, $value, $ttl) === false) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function fetch($key)
    {
        $key  = $this->createKeyArray($key);
        $data = $this->cache->getData($key);

        return isset($data['data']) ? $data['data'] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function contains($key)
    {
        return $this->fetch($key) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        $key = $this->createKeyArray($key);

        return $this->cache->clear($key);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        return $this->cache->clear();
    }
}
