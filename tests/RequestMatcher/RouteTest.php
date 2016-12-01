<?php

namespace CultuurNet\UDB3\HttpFoundation\RequestMatcher;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $pattern;

    /**
     * @var string[]
     */
    private $methods;

    /**
     * @var Route
     */
    private $path;

    protected function setUp()
    {
        $this->pattern = 'pattern';
        $this->methods = ['GET', 'POST'];

        $this->path = new Route($this->pattern, $this->methods);
    }

    /**
     * @test
     */
    public function it_stores_a_pattern()
    {
        $this->assertEquals($this->pattern, $this->path->getPathPattern());
    }

    /**
     * @test
     */
    public function it_stores_methods()
    {
        $this->assertEquals($this->methods, $this->path->getHttpMethods());
    }

    /**
     * @test
     */
    public function it_converts_single_method_to_array()
    {
        $path = new Route('pattern', 'GET');

        $this->assertEquals(['GET'], $path->getHttpMethods());
    }
}
