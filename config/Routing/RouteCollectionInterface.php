<?php

namespace Pollo\Config\Routing;

use Aura\Router\Router;

interface RouteCollectionInterface
{
    /**
     * Add routes to given router
     *
     * @param Router $router
     */
    public function addTo(Router $router);

    /**
     * Returns an array where keys are route actions
     * and value are correspondant controller classes
     *
     * @return array
     */
    public function getActionControllerMap();
}
