<?php

namespace CultuurNet\UDB3\HttpFoundation\RequestMatcher;

class Route
{
    /**
     * @var string
     */
    private $pathPattern;

    /**
     * @var string[]
     */
    private $httpMethods;

    /**
     * @param string $pathPattern
     * @param string|string[] $httpMethods
     */
    public function __construct($pathPattern, $httpMethods)
    {
        $this->pathPattern = $pathPattern;
        $this->httpMethods = is_array($httpMethods) ? $httpMethods : [$httpMethods];
    }

    /**
     * @return string
     */
    public function getPathPattern()
    {
        return $this->pathPattern;
    }

    /**
     * @return string[]
     */
    public function getHttpMethods()
    {
        return $this->httpMethods;
    }
}
