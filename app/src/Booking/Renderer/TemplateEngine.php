<?php

declare(strict_types=1);

namespace Booking\Renderer;

use App\Common\Renderer\TemplateEngineInterface;

class TemplateEngine implements TemplateEngineInterface
{
    protected $theme = '/var/www/skolkovo22_booking_proto/theme/default.php';

    public function __construct(protected string $content = '')
    {
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return void
     */
    public function includeTheme(): void
    {
        require_once $this->theme;
    }
}
