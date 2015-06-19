<?php

namespace Concat\Cache\Test\Adapter;

use Concat\Cache\Adapter\AdapterFactory;
use Mockery as m;

class AdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testIlluminate()
    {
        $driver  = m::mock('Illuminate\Contracts\Cache\Store');
        $adapter = AdapterFactory::get($driver);
        $this->assertInstanceOf('Concat\Cache\Adapter\IlluminateAdapter', $adapter);
    }

    public function testDoctrine()
    {
        $driver  = m::mock('Doctrine\Common\Cache\CacheProvider');
        $adapter = AdapterFactory::get($driver);
        $this->assertInstanceOf('Concat\Cache\Adapter\DoctrineAdapter', $adapter);
    }

    public function testStash()
    {
        $driver  = m::mock('Stash\Interfaces\DriverInterface');
        $adapter = AdapterFactory::get($driver);
        $this->assertInstanceOf('Concat\Cache\Adapter\StashAdapter', $adapter);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testUnsupported()
    {
        AdapterFactory::get(new \stdClass());
    }
}
