<?php

namespace Pollo\Web\Http;

use Aura\Web\Request as BaseRequest;

final class Request implements RequestInterface
{
    /** @var BaseRequest */
    private $request;

    /**
     * @param BaseRequest $request
     */
    public function __construct(BaseRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @inheritdoc
     */
    public function getQuery($key, $alt = null)
    {
        return $this->request->query->get($key, $alt);
    }

    /**
     * @inheritdoc
     */
    public function getPost($key, $alt = null)
    {
        return $this->request->post->get($key, $alt);
    }

    /**
     * @inheritdoc
     */
    public function getParam($key)
    {
        return $this->request->params[$key];
    }
}
