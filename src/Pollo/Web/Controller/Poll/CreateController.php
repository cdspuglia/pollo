<?php

namespace Pollo\Web\Controller\Poll;

use Pollo\Web\Command\CreatePoll;
use Pollo\Web\Controller\Controller;

final class CreateController extends Controller
{
    public function __invoke()
    {
        // dummy data
        $id = 'f47ac10b-58cc-4372-a567-' . substr(md5(time() . uniqid()), 0, 12);
        $title = 'Poll title ' . $id;

        $command = new CreatePoll($id, $title);
        $this->domain->apply($command);

        // no exceptions thrown, we can return a 201 response
    }
}
