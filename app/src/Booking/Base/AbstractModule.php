<?php

declare(strict_types=1);

namespace Booking\Base;

use App\Common\Routing\ModuleInterface;
use App\Common\Routing\RouterInterface;
use Booking\Http\Response;
use Booking\Renderer\TemplateEngine;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

abstract class AbstractModule implements ModuleInterface
{
    /**
     * @param RouterInterface $router
     */
    public function __construct(protected RouterInterface $router)
    {
    }

    /**
     * @return string
     */
    abstract protected function getModuleDir(): string;

    /**
     * @param string $view
     * @param array $vars
     *
     * @return ServerMessageInterface
     */
    protected function render(string $view, array $vars = []): ServerMessageInterface
    {
        $templateEngine = new TemplateEngine($this->renderView($view, $vars));

        ob_start();
        $templateEngine->includeTheme();
        $content = ob_get_contents();
        ob_end_clean();

        return new Response($content);
    }

    /**
    * @param string $view
    * @param array $vars
    *
    * @return string
    */
    protected function renderView(string $view, array $vars = []): string
    {
        extract($vars);
        unset($vars);

        $content = '';
        if (file_exists($this->getModuleDir() . '/' . $view)) {
            ob_start();
            require_once $this->getModuleDir() . '/' . $view;
            $content = ob_get_contents();
            ob_end_clean();
        }

        return $content;
    }
}
