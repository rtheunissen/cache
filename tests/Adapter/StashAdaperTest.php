<?php

namespace Concat\Cache\Test\Adapter;

use Concat\Cache\Adapter\StashAdapter;
use Mockery as m;

class StashAdapterTest extends AbstractAdapterTest
{
    const DELIMITER = "|";

    private function mock()
    {
        return m::mock('Stash\Interfaces\DriverInterface');
    }

    private function adapter($cache)
    {
        $adapter = new StashAdapter($cache);
        $adapter->setDelimiter(self::DELIMITER);

        return $adapter;
    }

    private function createArrayKey($key)
    {
        return explode(self::DELIMITER, $key);
    }

    protected function prepareSuccessfulStore($key, $value, $ttl)
    {
        $cache = $this->mock();

        $key = $this->createArrayKey($key);

        $cache->shouldReceive('storeData')
              ->with($key, $value, m::on(function($attl) use ($ttl) {
                  return time() + $ttl === $attl;
              }))
              ->andReturn(true);

        $cache->shouldReceive('getData')
              ->with($key)
              ->andReturn(['data' => $value]);

        return $this->adapter($cache);
    }

    protected function prepareFailedStore($key, $value, $ttl)
    {
        $cache = $this->mock();

        $key = $this->createArrayKey($key);
        $ttl = time() + $ttl;

        $cache->shouldReceive('storeData')
              ->with($key, $value, $ttl)
              ->andReturn(false);

        $cache->shouldReceive('getData')
              ->with($key)
              ->andReturn(null);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulFetch($key, $value)
    {
        $cache = $this->mock();

        $key = $this->createArrayKey($key);

        $cache->shouldReceive('getData')
              ->with($key)
              ->andReturn(['data' => $value]);

        return $this->adapter($cache);
    }

    protected function prepareFailedFetch($key, $value)
    {
        $cache = $this->mock();

        $key = $this->createArrayKey($key);

        $cache->shouldReceive('getData')
              ->with($key)
              ->andReturn(null);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulContains($key)
    {
        $cache = $this->mock();

        $key = $this->createArrayKey($key);

        $cache->shouldReceive('getData')
              ->with($key)
              ->andReturn(['data' => true]);

        return $this->adapter($cache);
    }

    protected function prepareFailedContains($key)
    {
        $cache = $this->mock();

        $key = $this->createArrayKey($key);

        $cache->shouldReceive('getData')
              ->with($key)
              ->andReturn(null);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulDelete($key)
    {
        $cache = $this->mock();

        $key = $this->createArrayKey($key);

        $cache->shouldReceive('clear')
              ->with($key)
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedDelete($key)
    {
        $cache = $this->mock();

        $key = $this->createArrayKey($key);

        $cache->shouldReceive('clear')
              ->with($key)
              ->andReturn(false);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulClear()
    {
        $cache = $this->mock();

        $cache->shouldReceive('clear')
              ->withNoArgs()
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedClear()
    {
        $cache = $this->mock();

        $cache->shouldReceive('clear')
              ->withNoArgs()
              ->andReturn(false);

        return $this->adapter($cache);
    }
}
