<?php

namespace Pollo\Web\Controller\Poll;

use Pollo\Web\Controller\Controller;

final class NewController extends Controller
{
    public function __invoke()
    {
        $content = $this->renderTemplate('Poll/new.html.twig');
        $this->getResponse()->setContent($content);
    }
}
