<?php

namespace Pollo\Config\Routing;

use Aura\Router\Router;

final class Poll implements RouteCollectionInterface
{
    /**
     * Add poll routes to given router
     *
     * @param Router $router
     */
    public function addTo(Router $router)
    {
        $router->addPost('poll.create', '/poll/create')
            ->setValues(
                array(
                    'action' => 'poll.create'
                )
            )
            ->setAccept(
                array(
                    'application/json',
                    'text/html'
                )
            );
    }

    /**
     * @inheritdoc
     */
    public function getActionControllerMap()
    {
        return array(
            'poll.create' => 'Pollo\Web\Controller\Poll\CreateController'
        );
    }
}
