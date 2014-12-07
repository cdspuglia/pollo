<?php

namespace Pollo\Web\Controller\CallForProposals;

use Pollo\Web\Controller\Controller;

final class GetCreateFormController extends Controller
{
    public function __invoke()
    {
        $content = $this->renderTemplate('CallForProposals/create.html.twig');
        $this->getResponse()->setContent($content);
    }
}
