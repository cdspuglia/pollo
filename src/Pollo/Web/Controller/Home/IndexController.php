<?php

namespace Pollo\Web\Controller\Home;

use Pollo\Web\Controller\Controller;

final class IndexController extends Controller
{
    public function __invoke()
    {
        $content = $this->templating->render('Home/index.html.twig');
        $this->response->setContent($content);
    }
}
