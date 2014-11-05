<?php

namespace Pollo\Web\Http;

interface RequestInterface
{
    /**
     * Get query parameter
     *
     * @param string $key
     * @param mixed $alt
     * @return mixed
     */
    public function getQuery($key, $alt = null);

    /**
     * Get post parameter
     *
     * @param string $key
     * @param mixed $alt
     * @return mixed
     */
    public function getPost($key, $alt = null);
}
