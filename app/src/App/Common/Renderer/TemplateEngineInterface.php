<?php

namespace App\Common\Renderer;

interface TemplateEngineInterface
{
    /**
     * @return string
     */
    public function getContent(): string;
}
