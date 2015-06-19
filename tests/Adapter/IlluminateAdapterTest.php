<?php

namespace Concat\Cache\Test\Adapter;

use Concat\Cache\Adapter\IlluminateAdapter;
use Mockery as m;

class IllumninateAdapterTest extends AbstractAdapterTest
{
    private function mock()
    {
        return m::mock('Illuminate\Contracts\Cache\Store');
    }

    private function adapter($cache)
    {
        return new IlluminateAdapter($cache);
    }

    protected function prepareSuccessfulStore($key, $value, $ttl)
    {
        $cache = $this->mock();

        $cache->shouldReceive('put')
              ->with($key, $value, floatval($ttl) / 60);

        $cache->shouldReceive('get')
              ->with($key)
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedStore($key, $value, $ttl)
    {
        $this->markTestSkipped("Always returns true on store");
    }

    protected function prepareSuccessfulFetch($key, $value)
    {
        $cache = $this->mock();

        $cache->shouldReceive('get')
              ->with($key)
              ->andReturn($value);

        return $this->adapter($cache);
    }

    protected function prepareFailedFetch($key, $value)
    {
        $cache = $this->mock();

        $cache->shouldReceive('get')
              ->with($key)
              ->andReturn(false);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulContains($key)
    {
        $cache = $this->mock();

        $cache->shouldReceive('get')
              ->with($key)
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedContains($key)
    {
        $cache = $this->mock();

        $cache->shouldReceive('get')
              ->with($key)
              ->andReturn(null);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulDelete($key)
    {
        $cache = $this->mock();

        $cache->shouldReceive('forget')
              ->with($key)
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedDelete($key)
    {
        $cache = $this->mock();

        $cache->shouldReceive('forget')
              ->with($key)
              ->andReturn(false);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulClear()
    {
        $cache = $this->mock();

        $cache->shouldReceive('flush')
              ->withNoArgs()
              ->andReturn(null);

        return $this->adapter($cache);
    }

    protected function prepareFailedClear()
    {
        $this->markTestSkipped("Always returns true on clear");
    }
}
