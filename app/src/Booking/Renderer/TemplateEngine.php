<?php

declare(strict_types=1);

namespace Booking\Renderer;

use App\Common\Renderer\TemplateEngineInterface;

class TemplateEngine implements TemplateEngineInterface
{
    protected $theme = '/var/www/skolkovo22_booking_proto/theme/default.php';

    /** @var string */
    protected $content = '';

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @inheritDoc
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return void
     */
    public function includeTheme(): void
    {
        require_once $this->theme;
    }
}
