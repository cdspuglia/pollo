<?php

namespace Pollo\Web\Templating;

interface TemplateEngineInterface
{
    /**
     * Render a template with given parameters
     *
     * @param string $template_name
     * @param array $params
     * @return string
     */
    public function render($template_name, array $params = null);
}
