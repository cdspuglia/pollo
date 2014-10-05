<?php

namespace PolloTest\Validator;

use Pollo\Validator\Uuidv4;
use PolloTest\TestCase;

class Uuidv4Test extends TestCase
{
    /** @test */
    public function valid_uuid_returns_true()
    {
        $validator = new Uuidv4();
        $validUuid = '123e4567-e89b-12d3-a456-426655440000';

        $this->assertTrue($validator->isSatisfiedBy($validUuid));
    }

    /** @test */
    public function invalid_uuid_returns_false()
    {
        $validator = new Uuidv4();
        $validUuid = 'invalid';

        $this->assertFalse($validator->isSatisfiedBy($validUuid));
    }
}
