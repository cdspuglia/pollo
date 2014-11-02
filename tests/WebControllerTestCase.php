<?php

namespace PolloTest;

/**
 * Class for Pollo we controller tests
 *
 * @package PolloTest
 */
abstract class WebControllerTestCase extends TestCase
{
    protected function getMockedArguments()
    {
        return array(
            'request' => $this->getMock('Pollo\Web\Http\RequestInterface'),
            'response' => $this->getMock('Pollo\Web\Http\ResponseInterface'),
            'templating' => $this->getMock('Pollo\Web\Templating\TemplateEngineInterface'),
            'domain' => $this->getMock('Pollo\Adapter\AdapterInterface')
        );
    }
}
