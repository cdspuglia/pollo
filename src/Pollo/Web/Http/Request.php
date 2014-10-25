<?php

namespace Pollo\Web\Http;

use Aura\Web\Request as BaseRequest;

final class Request implements RequestInterface
{
    /**
     * @param BaseRequest $request
     */
    public function __construct(BaseRequest $request)
    {
        $this->request = $request;
    }
}
