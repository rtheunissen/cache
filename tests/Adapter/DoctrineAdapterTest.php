<?php

namespace Concat\Cache\Test\Adapter;

use Concat\Cache\Adapter\DoctrineAdapter;
use Mockery as m;

class DoctrineAdapterTest extends AbstractAdapterTest
{
    private function mock()
    {
        return m::mock('Doctrine\Common\Cache\CacheProvider');
    }

    private function adapter($cache)
    {
        return new DoctrineAdapter($cache);
    }

    protected function prepareSuccessfulStore($key, $value, $ttl)
    {
        $cache = $this->mock();

        $cache->shouldReceive('save')
              ->with($key, $value, $ttl)
              ->andReturn(true);

        $cache->shouldReceive('contains')
              ->with($key)
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedStore($key, $value, $ttl)
    {
        $cache = $this->mock();

        $cache->shouldReceive('save')
              ->with($key, $value, $ttl)
              ->andReturn(false);

        $cache->shouldReceive('contains')
              ->with($key)
              ->andReturn(false);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulFetch($key, $value)
    {
        $cache = $this->mock();

        $cache->shouldReceive('fetch')
              ->with($key)
              ->andReturn($value);

        return $this->adapter($cache);
    }

    protected function prepareFailedFetch($key, $value)
    {
        $cache = $this->mock();

        $cache->shouldReceive('fetch')
              ->with($key)
              ->andReturn(false);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulContains($key)
    {
        $cache = $this->mock();

        $cache->shouldReceive('contains')
              ->with($key)
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedContains($key)
    {
        $cache = $this->mock();

        $cache->shouldReceive('contains')
              ->with($key)
              ->andReturn(false);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulDelete($key)
    {
        $cache = $this->mock();

        $cache->shouldReceive('delete')
              ->with($key)
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedDelete($key)
    {
        $cache = $this->mock();

        $cache->shouldReceive('delete')
              ->with($key)
              ->andReturn(false);

        return $this->adapter($cache);
    }

    protected function prepareSuccessfulClear()
    {
        $cache = $this->mock();

        $cache->shouldReceive('flushAll')
              ->withNoArgs()
              ->andReturn(true);

        return $this->adapter($cache);
    }

    protected function prepareFailedClear()
    {
        $cache = $this->mock();

        $cache->shouldReceive('flushAll')
              ->withNoArgs()
              ->andReturn(false);

        return $this->adapter($cache);
    }
}
