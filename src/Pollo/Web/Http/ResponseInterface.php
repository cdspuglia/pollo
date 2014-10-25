<?php

namespace Pollo\Web\Http;

interface ResponseInterface
{
    /**
     * Set the response content
     *
     * @param string $content
     */
    public function setContent($content);
}
