<?php

namespace CultuurNet\UDB3\HttpFoundation\RequestMatcher;

use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\HttpFoundation\Request;

class MultiRouteRequestMatcher implements RequestMatcherInterface
{
    /**
     * @var Route[]
     */
    protected $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    /**
     * Creates a new request matcher with the addition of the provided route.
     *
     * @param Route $route
     * @return MultiRouteRequestMatcher
     */
    public function matching(Route $route)
    {
        $matcher = clone $this;
        $matcher->routes[] = $route;
        return $matcher;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function matches(Request $request)
    {
        $match = false;

        if (is_array($this->routes)) {
            $i = 0;
            $pathCount = count($this->routes);

            while ($i < $pathCount && !$match) {
                $match = !!preg_match(
                    '{'.$this->routes[$i]->getPathPattern().'}',
                    rawurldecode($request->getPathInfo())
                );

                $allowedMethods = $this->routes[$i]->getHttpMethods();

                // if we have a matching path and we are checking for methods
                // make sure the method matches as well
                if ($match && !empty($allowedMethods)) {
                    $requestMethod = $request->getMethod();
                    $matchingMethods = array_filter($allowedMethods, function ($method) use ($requestMethod) {
                        return $requestMethod === $method;
                    });

                    $match = count($matchingMethods) > 0;
                }

                $i++;
            }
        }

        return $match;
    }
}
