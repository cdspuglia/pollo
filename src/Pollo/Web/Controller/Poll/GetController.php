<?php

namespace Pollo\Web\Controller\Poll;

use Pollo\Web\Controller\Controller;

final class GetController extends Controller
{
    public function __invoke()
    {
        $pollId = $this->getRequest()->getParam('id');
        $content = $this->renderResponse('Poll/index.html.twig', array('id' => $pollId));
        $this->getResponse()->setContent($content);
    }
}
