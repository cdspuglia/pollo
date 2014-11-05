<?php

namespace Pollo\Web\Controller\Poll;

use Pollo\Adapter\Exception\CannotApplyWebCommand;
use Pollo\Web\Command\CreatePoll;
use Pollo\Web\Controller\Controller;
use Pollo\Web\Http\StatusCode;

final class CreateController extends Controller
{
    public function __invoke()
    {
        $response = $this->getResponse();

        try {
            // dummy data
            $id = 'f47ac10b-58cc-4372-a567-' . substr(md5(time() . uniqid()), 0, 12);
            $title = 'Poll title ' . $id;

            $command = new CreatePoll($id, $title);
            $this->applyToDomain($command);

            $location = $this->generateUrl('poll.get', array('id' => $id));
            $response->setStatusCode(StatusCode::CREATED);
            $response->setHeaders(
                array('Location' => $location)
            );
        } catch (CannotApplyWebCommand $exception) {
            $response->setStatusCode(StatusCode::BAD_REQUEST);
        }
    }
}
