<?php

namespace Concat\Cache\Test\Adapter;

abstract class AbstractAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function valueProvider()
    {
        return [

            // Test various data types for serialization integrity
            ['key', 1],
            ['key', false],
            ['key', [1, 2, 3]],
            ['key', new \stdClass()],
        ];
    }

    /**
     * @dataProvider valueProvider
     */
    public function testSuccessfulStore($key, $value)
    {
        $cache = $this->prepareSuccessfulStore($key, $value, 1);
        $this->assertNotFalse($cache->store($key, $value, 1));
        $this->assertTrue($cache->contains($key));
    }

    /**
     * @dataProvider valueProvider
     */
    public function testFailedStore($key, $value)
    {
        $cache = $this->prepareFailedStore($key, $value, 1);
        $this->assertFalse($cache->store($key, $value, 1));
        $this->assertFalse($cache->contains($key));
    }

    /**
     * @dataProvider valueProvider
     */
    public function testSuccessfulFetch($key, $value)
    {
        $cache = $this->prepareSuccessfulFetch($key, $value);
        $this->assertEquals($value, $cache->fetch($key));
    }

    /**
     * @dataProvider valueProvider
     */
    public function testFailedFetch($key, $value)
    {
        $cache = $this->prepareFailedFetch($key, $value);
        $this->assertNull($cache->fetch($key));
    }

    /**
     * @dataProvider valueProvider
     */
    public function testSuccessfulContains($key)
    {
        $cache = $this->prepareSuccessfulContains($key);
        $this->assertTrue($cache->contains($key));
    }

    /**
     * @dataProvider valueProvider
     */
    public function testFailedContains($key)
    {
        $cache = $this->prepareFailedContains($key);
        $this->assertFalse($cache->contains($key));
    }

    /**
     * @dataProvider valueProvider
     */
    public function testSuccessfulDelete($key)
    {
        $cache = $this->prepareSuccessfulDelete($key);
        $this->assertNotFalse($cache->delete($key));
    }

    /**
     * @dataProvider valueProvider
     */
    public function testFailedDelete($key)
    {
        $cache = $this->prepareFailedDelete($key);
        $this->assertFalse($cache->delete($key));
    }

    public function testSuccessfulClear()
    {
        $cache = $this->prepareSuccessfulClear();
        $this->assertNotFalse($cache->clear());
    }

    public function testFailedClear()
    {
        $cache = $this->prepareFailedClear();
        $this->assertFalse($cache->clear());
    }
}
