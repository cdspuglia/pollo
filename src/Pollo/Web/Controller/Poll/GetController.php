<?php

namespace Pollo\Web\Controller\Poll;

use Pollo\Web\Controller\Controller;

final class GetController extends Controller
{
    public function __invoke()
    {
        $pollId = $this->request->getQuery('id');

        // fetch through repository
    }
}
