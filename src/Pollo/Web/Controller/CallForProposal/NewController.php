<?php

namespace Pollo\Web\Controller\CallForProposal;

use Pollo\Web\Controller\Controller;

final class NewController extends Controller
{
    public function __invoke()
    {
        $content = $this->renderTemplate('CallForProposal/new.html.twig');
        $this->getResponse()->setContent($content);
    }
}
