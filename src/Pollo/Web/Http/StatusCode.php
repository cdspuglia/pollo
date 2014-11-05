<?php

namespace Pollo\Web\Http;

abstract class StatusCode
{
    const OK = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;

    const BAD_REQUEST = 400;
    const NOT_FOUND = 404;
}
