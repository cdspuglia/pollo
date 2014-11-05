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

    /**
     * @inheritdoc
     */
    public function setStatusCode($code)
    {
        $this->response->status->setCode($code);
    }

    /**
     * @inheritdoc
     */
    public function setHeaders(array $headers)
    {
        foreach ($headers as $headerName => $headerValue) {
            $this->response->headers->set($headerName, $headerValue);
        }
    }
}
