<?php

namespace Concat\Cache;

/**
 * An interface for basic caching.
 */
interface CacheInterface
{
    /**
     * Maps a key to a value in the cache.
     *
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl Time in seconds that the value should be cached for.
     *                    Implementations may store values for longer than this
     *                    time, after which it can not be gauranteed that the
     *                    value exists in the cache.
     *
     * @return boolean|null FALSE if the value could not be stored.
     */
    public function store($key, $value, $ttl = 0);

    /**
     * Retrieves a value from the cache.
     *
     * @param string $key
     *
     * @return mixed The cached value if successful, NULL otherwise.
     */
    public function fetch($key);

    /**
     * Determines whether the cache contains a given key. It's possible that a
     * key exists in the cache even if it's time-to-live has passed.
     *
     * @param string $key
     *
     * @return boolean
     */
    public function contains($key);

    /**
     * Deletes a key from the cache.
     *
     * @param string $key
     *
     * @return boolean|null FALSE if failed to delete.
     */
    public function delete($key);

    /**
     * Clears all cache data.
     *
     * @return boolean|null FALSE if failed to clear.
     */
    public function clear();
}
