<?php

namespace PolloTest\Web\Controller\Home;

use Pollo\Web\Controller\Home\IndexController;
use PolloTest\TestCase;

class IndexControllerTest extends TestCase
{
    /** @test */
    public function response_contains_pollo_homepage()
    {
        $request = $this->getMock('Pollo\Web\Http\RequestInterface');
        $response = $this->getMock('Pollo\Web\Http\ResponseInterface');
        $templating = $this->getMock('Pollo\Web\Templating\TemplateEngineInterface');

        $response
            ->expects($this->once())
            ->method('setContent')
            ->with($this->stringContains('Pollo homepage'));

        $templating
            ->method('render')
            ->willReturn('<h1>Pollo homepage</h1>');

        $controller = new IndexController($request, $response, $templating);
        $controller->__invoke();
    }
}
