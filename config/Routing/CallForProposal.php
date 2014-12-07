<?php

namespace Pollo\Config\Routing;

use Aura\Router\Router;

final class CallForProposal implements RouteCollectionInterface
{
    /**
     * Add poll routes to given router
     *
     * @param Router $router
     */
    public function addTo(Router $router)
    {
        $router->addGet('call-for-proposal.new', '/call-for-proposal/new')
            ->setValues(array('action' => 'call-for-proposal.new'))
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
            'call-for-proposal.new' => 'Pollo\Web\Controller\CallForProposal\NewController',
        );
    }
}
