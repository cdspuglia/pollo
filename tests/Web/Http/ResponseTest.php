<?php

namespace PolloTest\Web\Http;

use Pollo\Web\Http\Response;
use PolloTest\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function base_response_content_is_set()
    {
        $baseResponse = $this
            ->getMockBuilder('Aura\Web\Response')
            ->disableOriginalConstructor()
            ->getMock();

        $baseContent = $this
            ->getMockBuilder('Aura\Web\Response\Content')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $baseResponse
            ->expects($this->once())
            ->method('__get')
            ->with($this->equalTo('content'))
            ->willReturn($baseContent);

        $response = new Response($baseResponse);
        $response->setContent('response content');

        $this->assertSame('response content', $baseContent->get());
    }

    /**
     * @test
     * @group unit
     */
    public function base_response_status_code_is_set()
    {
        $baseResponse = $this
            ->getMockBuilder('Aura\Web\Response')
            ->disableOriginalConstructor()
            ->getMock();

        $baseStatus = $this
            ->getMockBuilder('Aura\Web\Response\Status')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $baseResponse
            ->expects($this->once())
            ->method('__get')
            ->with($this->equalTo('status'))
            ->willReturn($baseStatus);

        $response = new Response($baseResponse);
        $response->setStatusCode(200);

        $this->assertSame(200, $baseStatus->getCode());
    }

    /**
     * @test
     * @group unit
     */
    public function base_response_headers_are_set()
    {
        $baseResponse = $this
            ->getMockBuilder('Aura\Web\Response')
            ->disableOriginalConstructor()
            ->getMock();

        $baseHeaders = $this
            ->getMockBuilder('Aura\Web\Response\Headers')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $baseResponse
            ->expects($this->once())
            ->method('__get')
            ->with($this->equalTo('headers'))
            ->willReturn($baseHeaders);

        $headers = array(
            'Content-type' => 'application/json'
        );

        $response = new Response($baseResponse);
        $response->setHeaders($headers);

        $this->assertSame($headers['Content-type'], $baseHeaders->get('Content-type'));
    }
}
