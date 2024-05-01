<?php

declare(strict_types=1);

namespace Booking\Base;

use App\Common\Routing\ModuleInterface;
use Booking\Http\Response;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

abstract class AbstractModule implements ModuleInterface
{
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
        extract($vars);
        unset($vars);

        $content = '';
        if (file_exists($this->getModuleDir() . '/' . $view)) {
            ob_start();
            require_once $this->getModuleDir() . '/' . $view;
            $content = ob_get_contents();
            ob_end_clean();
        }

        return new Response($content);
    }
}
