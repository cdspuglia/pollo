<?php

namespace PolloTest\Web\Router;

use Pollo\Web\Router\Router;
use PolloTest\TestCase;

class RouterTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function generate_returns_expected_url()
    {
        $baseRouter = $this->getMockBuilder('Aura\Router\Router')
            ->disableOriginalConstructor()
            ->getMock();

        $expectedUrl = '/path/to/url';
        $baseRouter
            ->expects($this->once())
            ->method('generate')
            ->willReturn($expectedUrl);

        $router = new Router($baseRouter);
        $url = $router->generate('route');

        $this->assertEquals($expectedUrl, $url);
    }
}
