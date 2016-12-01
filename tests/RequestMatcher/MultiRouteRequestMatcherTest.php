<?php

namespace CultuurNet\UDB3\HttpFoundation\RequestMatcher;

use Symfony\Component\HttpFoundation\Request;

class MultiRouteRequestMatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_does_not_match_any_request_when_no_paths_are_provided()
    {
        $requestMatcher = new MultiRouteRequestMatcher();

        $matches = $requestMatcher->matches(new Request());
        $this->assertFalse($matches);
    }

    /**
     * @test
     */
    public function it_should_match_against_one_of_mutiple_methods_on_the_same_path()
    {
        $matcher = new MultiRouteRequestMatcher();
        $matcher = $matcher->matching(new Route('^/foo/bar', ['DELETE', 'POST']));

        $request = Request::create('/foo/bar', 'POST');
        $match = $matcher->matches($request);
        $this->assertTrue($match);
    }

    /**
     * @test
     */
    public function it_should_not_match_against_a_missing_method_of_multi_method_path()
    {
        $matcher = new MultiRouteRequestMatcher();
        $matcher = $matcher->matching(new Route('^/foo/bar', ['DELETE', 'POST']));

        $request = Request::create('/foo/bar', 'GET');
        $match = $matcher->matches($request);
        $this->assertFalse($match);
    }
}
