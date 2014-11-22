<?php

namespace Pollo\Config\Routing;

use Aura\Router\Router;

final class CallForProposals implements RouteCollectionInterface
{
    /**
     * Add poll routes to given router
     *
     * @param Router $router
     */
    public function addTo(Router $router)
    {
        $router->addGet('poll.get', '/call-for-proposals/create')
            ->setValues(array('action' => 'call-for-proposals.get'))
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
            'call-for-proposals.get' => 'Pollo\Web\Controller\CallForProposals\GetCreateFormController',
        );
    }
}
