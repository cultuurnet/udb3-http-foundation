<?php

namespace CultuurNet\UDB3\HttpFoundation;

use Crell\ApiProblem\ApiProblem;
use Symfony\Component\HttpFoundation\Response;

class ApiProblemJsonResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_has_400_bad_request_as_default_status()
    {
        $apiProblemJsonResponse = new ApiProblemJsonResponse(new ApiProblem());

        $this->assertEquals(
            Response::HTTP_BAD_REQUEST,
            $apiProblemJsonResponse->getStatusCode()
        );
    }

    /**
     * @test
     */
    public function it_uses_status_from_the_given_api_problem_if_it_has_one()
    {
        $apiProblem = new ApiProblem();
        $apiProblem->setStatus(Response::HTTP_NOT_FOUND);

        $apiProblemJsonResponse = new ApiProblemJsonResponse($apiProblem);

        $this->assertEquals(
            Response::HTTP_NOT_FOUND,
            $apiProblemJsonResponse->getStatusCode()
        );
    }
}