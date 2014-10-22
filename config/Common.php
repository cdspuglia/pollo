<?php

namespace Pollo\Config;

use Aura\Di\Config;
use Aura\Di\Container;
use Pollo\Config\Routing\Home;

class Common extends Config
{
    public function define(Container $di)
    {
        $di->set('aura/project-kernel:logger', $di->lazyNew('Monolog\Logger'));

        $di->set('pollo/templating', $di->lazyNew('Pollo\Web\Templating\TwigTemplateEngine', array(
            'loader' => $di->lazyNew(
                '\Twig_Loader_Filesystem',
                array(__DIR__ . '/../src/Pollo/Web/Resources/templates')
            ),
            'options' => array('cache' => __DIR__ . '/../tmp/cache/twig')
        )));

        $di->params['Pollo\Web\Controller\Controller'] = array(
            'request' => $di->lazyGet('aura/web-kernel:request'),
            'response' => $di->lazyGet('aura/web-kernel:response'),
            'templating' => $di->lazyGet('pollo/templating'),
        );
    }

    public function modify(Container $di)
    {
        $this->modifyLogger($di);
        $this->modifyCliDispatcher($di);

        $this->registerRoutes($di);
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

    public function registerRoutes(Container $di)
    {
        $routeCollections = $this->getRouteCollections();

        /** @var Aura\Router\Router $router */
        $router = $di->get('aura/web-kernel:router');

        /** @var Aura\Dispatcher\Dispatcher $dispatcher */
        $dispatcher = $di->get('aura/web-kernel:dispatcher');

        /** @var Pollo\Config\Routing\RouteCollectionInterface $routeCollection */
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
     * @return Pollo\Config\Routing\RouteCollectionInterface[]
     */
    protected function getRouteCollections()
    {
        return array(
            new Home()
        );
    }
}
