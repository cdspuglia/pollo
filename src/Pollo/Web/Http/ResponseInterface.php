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
}
