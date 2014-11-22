<?php

namespace Pollo\Config;

use Aura\Di\Config;
use Aura\Di\Container;
use Pollo\Config\Routing\Home;
use Pollo\Config\Routing\Poll;
use Pollo\Core\ReadModel\Projector\PollProjector;
use Pollo\Core\ReadModel\Repository\PollRepository;

class Common extends Config
{
    public function define(Container $di)
    {
        // Logger
        $di->set('aura/project-kernel:logger', $di->lazyNew('Monolog\Logger'));

        // Template engine
        $di->set('pollo/web:templating', $di->lazyNew('Pollo\Web\Templating\TwigTemplateEngine', array(
            'loader' => $di->lazyNew(
                '\Twig_Loader_Filesystem',
                array(__DIR__ . '/../src/Pollo/Web/Resources/templates')
            ),
            'options' => array('cache' => __DIR__ . '/../tmp/cache/twig')
        )));

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

        // Elastic search client
        $di->set('pollo/elasticsearch-client', $di->lazyNew('ElasticSearch\Client'));

        // Serializer
        $di->set('pollo/core:serializer', $di->lazyNew('Pollo\Core\Serializer\Serializer'));

        // Read model repository factory
        $di->set(
            'pollo/core/read-model:repository-factory',
            $di->lazyNew('Pollo\Core\ReadModel\Repository\RepositoryFactory', array(
                'client' => $di->lazyGet('pollo/elasticsearch-client'),
                'serializer' => $di->lazyGet('pollo/core:serializer')
            ))
        );

        // Read model projectors
        $di->set('pollo/core/read-model:poll-projector', $di->lazyNew('Pollo\Core\ReadModel\Projector\PollProjector', array(
            'factory' => $di->lazyGet('pollo/core/read-model:repository-factory')
        )));
    }

    public function modify(Container $di)
    {
        $this->modifyLogger($di);
        $this->modifyCliDispatcher($di);

        $this->registerRoutes($di);
        $this->registerCommandHandlers($di);
        $this->registerProjectors($di);
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
            new Poll()
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

    protected function registerProjectors($di)
    {
        $projectorRepositoryMap = $this->getProjectorRepositoryMap();
        $eventBus = $di->get('pollo/core:event-bus');
        $factory = $di->get('pollo/core/read-model:repository-factory');

        foreach ($projectorRepositoryMap as $projector => $repositoryClass) {
            $repositoryName = $repositoryClass::getName();
            $repository = $factory->create($repositoryName, $repositoryClass);
            $projector = new PollProjector($repository);
            $eventBus->subscribe($projector);
        }
    }

    protected function getCommandHandlerRepositoryServiceMap()
    {
        return array(
            'Pollo\Core\Domain\CommandHandler\PollCommandHandler'
                => 'pollo/core:poll-repository'
        );
    }

    protected function getProjectorRepositoryMap()
    {
        return array(
            'pollo/core/read-model:poll-projector' => PollRepository::class
        );
    }
}
