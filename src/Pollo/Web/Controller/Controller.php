<?php

namespace Pollo\Web\Controller;

use Pollo\Adapter\AdapterInterface;
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

    /** @var AdapterInterface */
    protected $domain;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param TemplateEngineInterface $templating
     * @param AdapterInterface $domain
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        TemplateEngineInterface $templating,
        AdapterInterface $domain
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->templating = $templating;
        $this->domain = $domain;
    }
}
