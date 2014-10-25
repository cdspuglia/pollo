<?php

namespace Pollo\Web\Controller;

use Pollo\Web\Http\RequestInterface;
use Pollo\Web\Http\ResponseInterface;
use Pollo\Web\Templating\TemplateEngineInterface;

abstract class Controller
{
    /** @var RequestInterface */
    protected $request;

    /** @var ResponseInterface  */
    protected $response;

    /** @var TemplateEngineInterface  */
    protected $templating;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param TemplateEngineInterface $templating
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        TemplateEngineInterface $templating
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->templating = $templating;
    }
}
