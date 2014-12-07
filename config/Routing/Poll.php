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

        $router->addGet('poll.new', '/poll/new')
            ->setValues(array('action' => 'poll.new'))
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
            'poll.get' => 'Pollo\Web\Controller\Poll\GetController',
            'poll.create' => 'Pollo\Web\Controller\Poll\CreateController',
            'poll.new' => 'Pollo\Web\Controller\Poll\NewController',
        );
    }
}
