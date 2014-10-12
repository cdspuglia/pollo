<?php

namespace Pollo\Web\Controller;

use Aura\Web\Request;
use Aura\Web\Response;

abstract class Controller
{
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
