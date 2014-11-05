<?php

namespace Pollo\Web\Http;

interface ResponseInterface
{
    /**
     * Set the response content
     *
     * @param string $content
     * @return void
     */
    public function setContent($content);

    /**
     * Set the response status code
     *
     * @param int $code
     * @return void
     */
    public function setStatusCode($code);

    /**
     * Set the response headers
     *
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers);
}
