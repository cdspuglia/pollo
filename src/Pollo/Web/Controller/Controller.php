<?php

namespace Pollo\Web\Controller;

use Aura\Web\Request;
use Aura\Web\Response;
use Pollo\Web\Templating\TemplateEngineInterface;

abstract class Controller
{
    protected $request;
    protected $response;
    protected $templating;

    public function __construct(Request $request, Response $response, TemplateEngineInterface $templating)
    {
        $this->request = $request;
        $this->response = $response;
        $this->templating = $templating;
    }
}
