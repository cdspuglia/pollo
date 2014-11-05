<?php

namespace Pollo\Web\Controller;

use Pollo\Adapter\AdapterInterface;
use Pollo\Adapter\Command\CommandInterface;
use Pollo\Web\Http\RequestInterface;
use Pollo\Web\Http\ResponseInterface;
use Pollo\Web\Router\RouterInterface;
use Pollo\Web\Templating\TemplateEngineInterface;

abstract class Controller
{
    /** @var RequestInterface */
    private $request;

    /** @var ResponseInterface  */
    private $response;

    /** @var TemplateEngineInterface  */
    private $templating;

    /** @var RouterInterface */
    private $router;

    /** @var AdapterInterface */
    private $domain;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param TemplateEngineInterface $templating
     * @param RouterInterface $router
     * @param AdapterInterface $domain
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        TemplateEngineInterface $templating,
        RouterInterface $router,
        AdapterInterface $domain
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->templating = $templating;
        $this->router = $router;
        $this->domain = $domain;
    }

    /**
     * @param CommandInterface $command
     */
    protected function applyToDomain(CommandInterface $command)
    {
        $this->domain->apply($command);
    }

    /**
     * @return RequestInterface
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    protected function getResponse()
    {
        return $this->response;
    }

    /**
     * Returns a URL from given route name and parameters
     *
     * @param string $route
     * @param array $parameters
     * @return mixed
     */
    protected function generateUrl($route, array $parameters = null)
    {
        return $this->router->generate($route, $parameters);
    }

    /**
     * Returns a rendered template
     *
     * @param string $template
     * @param array $parameters
     * @return string
     */
    protected function renderTemplate($template, array $parameters = array())
    {
        return $this->templating->render($template, $parameters);
    }
}
