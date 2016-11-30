<?php

namespace CultuurNet\UDB3\HttpFoundation;

class JsonLdResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_adds_a_jsonld_content_type_header()
    {
        $data = ['@id' => 'http://acme.com/foo'];
        $response = new JsonLdResponse($data);
        $contentType = $response->headers->get('Content-Type', '');

        $this->assertEquals('application/ld+json', $contentType);
    }
}
