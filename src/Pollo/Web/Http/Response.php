<?php

namespace Pollo\Web\Http;

use \Aura\Web\Response as BaseResponse;

final class Response implements ResponseInterface
{
    private $response;

    /**
     * @param BaseResponse $response
     */
    public function __construct(BaseResponse $response)
    {
        $this->response = $response;
    }

    /**
     * @inheritdoc
     */
    public function setContent($content)
    {
        $this->response->content->set($content);
    }
}
