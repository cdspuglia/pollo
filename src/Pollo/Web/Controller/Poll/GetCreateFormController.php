<?php

namespace Pollo\Web\Controller\Poll;

use Pollo\Web\Controller\Controller;

final class GetCreateFormController extends Controller
{
    public function __invoke()
    {
        $content = $this->renderTemplate('Poll/create.html.twig');
        $this->getResponse()->setContent($content);
    }
}
