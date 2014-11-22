<?php

namespace Pollo\Config;

use Aura\Di\Config;
use Aura\Di\Container;
use Pollo\Config\Routing\CallForProposals;
use Pollo\Config\Routing\Home;
use Pollo\Config\Routing\Poll;

class Common extends Config
{
    public function define(Container $di)
    {
        // Logger
        $di->set('aura/project-kernel:logger', $di->lazyNew('Monolog\Logger'));

        // Web request / response
        $di->set('pollo/web:request', $di->lazyNew('Pollo\Web\Http\Request', array(
            'request' => $di->lazyGet('aura/web-kernel:request')
        )));
        $di->set('pollo/web:response', $di->lazyNew('Pollo\Web\Http\Response', array(
            'response' => $di->lazyGet('aura/web-kernel:response')
        )));

        // Router
        $di->set('pollo/web:router', $di->lazyNew('Pollo\Web\Router\Router', array(
            'router' => $di->lazyGet('aura/web-kernel:router')
        )));

        // Command bus
        $di->set('pollo/command-bus', $di->lazyNew('Broadway\CommandHandling\SimpleCommandBus'));

        // Web/Domain adapter
        $di->set('pollo/adapter:web-domain-adapter', $di->lazyNew('Pollo\Adapter\WebDomainAdapter', array(
            'bus' => $di->lazyGet('pollo/command-bus'),
            'mapper' => $di->lazyNew('Pollo\Adapter\Mapper\WebCommandMapper')
        )));

        // Web controller parameters
        $di->params['Pollo\Web\Controller\Controller'] = array(
            'request' => $di->lazyGet('pollo/web:request'),
            'response' => $di->lazyGet('pollo/web:response'),
            'templating' => $di->lazyGet('pollo/web:templating'),
            'router' => $di->lazyGet('pollo/web:router'),
            'domain' => $di->lazyGet('pollo/adapter:web-domain-adapter')
        );

        // EventStore client
        $di->set('pollo/event-store-client', $di->lazyNew('EventStore\EventStore', array(
            'url' => 'http://127.0.0.1:2113'
        )));

        // Event store
        $di->set('pollo/core:event-store', $di->lazyNew('Pollo\Core\EventStore\EventStore', array(
            'eventStore' => $di->lazyGet('pollo/event-store-client')
        )));

        // Event publisher
        $di->set('pollo/core:event-bus', $di->lazyNew('Broadway\EventHandling\SimpleEventBus'));

        // Domain repositories
        $di->set('pollo/core:poll-repository', $di->lazyNew('Pollo\Core\Domain\Repository\PollRepository', array(
            'eventStore' => $di->lazyGet('pollo/core:event-store'),
            'eventBus' => $di->lazyGet('pollo/core:event-bus')
        )));
    }

    public function modify(Container $di)
    {
        $this->modifyLogger($di);
        $this->modifyCliDispatcher($di);

        $this->registerRoutes($di);
        $this->registerCommandHandlers($di);
    }

    protected function modifyLogger(Container $di)
    {
        $project = $di->get('project');
        $mode = $project->getMode();
        $file = $project->getPath("tmp/log/{$mode}.log");

        $logger = $di->get('aura/project-kernel:logger');
        $logger->pushHandler($di->newInstance(
            'Monolog\Handler\StreamHandler',
            array(
                'stream' => $file,
            )
        ));
    }

    protected function modifyCliDispatcher(Container $di)
    {
        $context = $di->get('aura/cli-kernel:context');
        $stdio = $di->get('aura/cli-kernel:stdio');
        $logger = $di->get('aura/project-kernel:logger');
        $dispatcher = $di->get('aura/cli-kernel:dispatcher');
        $dispatcher->setObject(
            'hello',
            function ($name = 'World') use ($context, $stdio, $logger) {
                $stdio->outln("Hello {$name}! {$_ENV['AURA_CONFIG_MODE']}");
                $logger->debug("Said hello to '{$name}'");
            }
        );
    }

    protected function registerRoutes(Container $di)
    {
        $routeCollections = $this->getRouteCollections();

        /** @var \Aura\Router\Router $router */
        $router = $di->get('aura/web-kernel:router');

        /** @var \Aura\Dispatcher\Dispatcher $dispatcher */
        $dispatcher = $di->get('aura/web-kernel:dispatcher');

        /** @var \Pollo\Config\Routing\RouteCollectionInterface $routeCollection */
        foreach ($routeCollections as $routeCollection) {
            $routeCollection->addTo($router);

            $actionControllerMap = $routeCollection->getActionControllerMap();
            foreach ($actionControllerMap as $action => $controller) {
                $dispatcher->setObject($action, $di->lazyNew($controller));
            }
        }
    }

    /**
     * Returns all route collection of the application
     *
     * @return \Pollo\Config\Routing\RouteCollectionInterface[]
     */
    protected function getRouteCollections()
    {
        return array(
            new Home(),
            new Poll(),
            new CallForProposals()
        );
    }

    protected function registerCommandHandlers(Container $di)
    {
        $map = $this->getCommandHandlerRepositoryServiceMap();
        $bus = $di->get('pollo/command-bus');

        foreach ($map as $handlerClass => $repositoryService) {
            $repository = $di->get($repositoryService);
            $handler = new $handlerClass($repository);
            $bus->subscribe($handler);
        }
    }

    protected function getCommandHandlerRepositoryServiceMap()
    {
        return array(
            'Pollo\Core\Domain\CommandHandler\PollCommandHandler'
                => 'pollo/core:poll-repository'
        );
    }
}
