<?php

namespace Pollo\Web\Controller\Poll;

use Pollo\Web\Controller\Controller;

final class GetController extends Controller
{
    public function __invoke()
    {
        $pollId = $this->getRequest()->getQuery('id');

        // fetch through repository
    }
}
