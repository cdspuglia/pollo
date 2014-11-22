<?php

namespace Pollo\Config\Routing;

use Aura\Router\Router;
use Rhumsaa\Uuid\Uuid;

final class Poll implements RouteCollectionInterface
{
    /**
     * Add poll routes to given router
     *
     * @param Router $router
     */
    public function addTo(Router $router)
    {
        $router->addGet('poll.get', '/poll/create')
            ->setValues(array('action' => 'poll.get'))
            ->setAccept(
                array(
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
            'poll.get' => 'Pollo\Web\Controller\Poll\GetCreateFormController',
        );
    }
}
