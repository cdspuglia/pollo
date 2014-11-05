<?php

namespace PolloTest\Web\Controller\Home;

use Pollo\Web\Controller\Home\IndexController;
use PolloTest\WebControllerTestCase;

class IndexControllerTest extends WebControllerTestCase
{
    /**
     * @test
     * @group unit
     */
    public function response_contains_pollo_homepage()
    {
        $args = $this->getMockedArguments();

        $args['response']
            ->expects($this->once())
            ->method('setContent')
            ->with($this->stringContains('Pollo homepage'));

        $args['templating']
            ->method('render')
            ->willReturn('<h1>Pollo homepage</h1>');

        $controller = new IndexController(
            $args['request'],
            $args['response'],
            $args['templating'],
            $args['router'],
            $args['domain']
        );

        $controller->__invoke();
    }
}
