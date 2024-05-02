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
    /** @var string */
    protected $viewDir;

    /** @var RouterInterface */
    protected $router;

    /**
     * @param string $viewDir
     *
     * @return void
     */
    final public function setViewDir(string $viewDir): void
    {
        if (is_null($this->viewDir)) {
            $this->viewDir = $viewDir;
        }
    }

    /**
     * @param RouterInterface $router
     *
     * @return void
     */
    final public function setRouter(RouterInterface $router): void
    {
        if (is_null($this->router)) {
            $this->router = $router;
        }
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
        $templateEngine = new TemplateEngine();
        $templateEngine->setContent($this->renderView($view, $vars));

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
        if (file_exists($this->viewDir . '/' . $view)) {
            ob_start();
            require_once $this->viewDir . '/' . $view;
            $content = ob_get_contents();
            ob_end_clean();
        }

        return $content;
    }
}
