<?php

namespace Pollo\Config\Routing;

use Aura\Router\Router;

final class Home implements RouteCollectionInterface
{
    /**
     * Add home route to given router
     *
     * @param Router $router
     */
    public function addTo(Router $router)
    {
        $router->addGet('home', '/')
            ->setValues(
                array(
                    'action' => 'home.index'
                )
            );
    }

    /**
     * @inheritdoc
     */
    public function getActionControllerMap()
    {
        return array(
            'home.index' => 'Pollo\Web\Controller\Home\IndexController'
        );
    }
}
