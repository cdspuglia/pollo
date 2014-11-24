<?php

namespace PolloTest\Core\ReadModel\Model;

use Broadway\ReadModel\Testing\ReadModelTestCase;
use Pollo\Core\ReadModel\Model\Poll;
use ValueObjects\Identity\UUID;

class PollTest extends ReadModelTestCase
{
    public function createReadModel()
    {
        return new Poll(UUID::generateAsString(), 'Poll title');
    }
}
