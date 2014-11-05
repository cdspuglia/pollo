<?php

namespace Pollo\Web\Router;

interface RouterInterface
{
    /**
     * Generates a URL
     *
     * @param string $route
     * @param array $parameters
     * @return mixed
     */
    public function generate($route, array $parameters = null);
}
