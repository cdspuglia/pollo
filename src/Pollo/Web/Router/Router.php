<?php

namespace Pollo\Web\Router;

final class Router implements RouterInterface
{
    /**
     * @var \Aura\Router\Router
     */
    private $router;

    /**
     * @param \Aura\Router\Router $router
     */
    public function __construct(\Aura\Router\Router $router)
    {
        $this->router = $router;
    }

    /**
     * @inheritdoc
     */
    public function generate($route, array $parameters = null)
    {
        return $this->router->generate($route, $parameters);
    }
}
