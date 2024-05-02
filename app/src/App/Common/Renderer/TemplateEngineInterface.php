<?php

namespace App\Common\Renderer;

interface TemplateEngineInterface
{
    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $content
     *
     * @return void
     */
    public function setContent(string $content): void;

    /**
     * @return void
     */
    public function includeTheme(): void;
}
