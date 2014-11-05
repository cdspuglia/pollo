<?php

namespace Pollo\Web\Controller\Home;

use Pollo\Web\Controller\Controller;

final class IndexController extends Controller
{
    public function __invoke()
    {
        $content = $this->renderTemplate('Home/index.html.twig');
        $this->getResponse()->setContent($content);
    }
}
