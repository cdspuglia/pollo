<?php

namespace Pollo\Web\Controller;

use Monolog\Logger;
use Pollo\Adapter\AdapterInterface;
use Pollo\Adapter\Command\CommandInterface;
use Pollo\Web\Http\RequestInterface;
use Pollo\Web\Http\ResponseInterface;
use Pollo\Web\Router\RouterInterface;
use Pollo\Web\Templating\TemplateEngineInterface;
use Aura\Accept\AcceptFactory;

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

    CONST APPLICATION_JSON = 'application/json';
    CONST TEXT_HTML = 'text/html';

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
    private function renderTemplate($template, array $parameters = array())
    {
        return $this->templating->render($template, $parameters);
    }


    /**
     * Returns a json containing parameters
     *
     * @param array $parameters
     * @return string
     */
    private function renderJson(array $parameters)
    {
        $jsonResponse =  json_encode($parameters);
        $this->response->setHeaders(array('Content-Type' => self::APPLICATION_JSON));
        return $jsonResponse;
    }

    /**
     * Renders the response depending on Accept HTTP header
     *
     * @param $response
     * @param array $parameters
     * @return string
     */
    protected function renderResponse($response, array $parameters = array())
    {
        $negotiatedMedia = $this->getNegotiatedMedia();
        if ($negotiatedMedia == self::APPLICATION_JSON)
        {
            return $this->renderJson($parameters);
        }
        else if ($negotiatedMedia == self::TEXT_HTML)
        {
            return $this->renderTemplate($response, $parameters);
        }
    }

    /**
     * Returns the negotiated media
     *
     * @return string
     */
    private  function getNegotiatedMedia()
    {
        $available = array(
            self::APPLICATION_JSON,
            self::TEXT_HTML,
        );
        $accept_factory = new AcceptFactory($_SERVER);
        $accept = $accept_factory->newInstance();
        return $accept->negotiateMedia($available)->getValue();
    }
}
