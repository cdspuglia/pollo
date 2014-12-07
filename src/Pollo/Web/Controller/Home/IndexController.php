<?php

namespace Pollo\Web\Controller\Home;

use Pollo\Web\Controller\Controller;

final class IndexController extends Controller
{
    public function __invoke()
    {
        $content = $this->renderTemplate(
            'Home/index.html.twig',
            array (
                'hotTopics' => array (
                    array ( 'description' => 'Call For Proposal: Proponetevi per l\'evento di Gennaio'),
                    array ( 'description' => 'Votate il talk che vorreste ascoltare a Dicembre')
                ),
                'topics' => array (
                    array ( 'description' => 'Call For Proposal: Proponetevi per l\'evento di Gennaio'),
                    array ( 'description' => 'Votate il talk che vorreste ascoltare a Dicembre'),
                    array ( 'description' => 'Votate il talk che vorreste ascoltare a Dicembre'),
                    array ( 'description' => 'Votate il talk che vorreste ascoltare a Dicembre'),
                    array ( 'description' => 'Votate il talk che vorreste ascoltare a Dicembre'),
                    array ( 'description' => 'Votate il talk che vorreste ascoltare a Dicembre'),
                    array ( 'description' => 'Votate il talk che vorreste ascoltare a Dicembre')
                )
            )
        );
        $this->getResponse()->setContent($content);
    }
}
