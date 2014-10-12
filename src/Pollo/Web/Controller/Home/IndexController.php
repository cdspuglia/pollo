<?php

namespace Pollo\Web\Controller\Home;

use Pollo\Web\Controller\Controller;

final class IndexController extends Controller
{
    public function __invoke()
    {
        $content = "<h1>Pollo homepage</h1>";
        $this->response->content->set($content);
    }
}
