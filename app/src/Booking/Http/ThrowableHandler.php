<?php

declare(strict_types=1);

namespace Booking\Http;

use App\Common\Http\HttpException;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

final class ThrowableHandler
{
    /** @var string */
    private $templateDirectory;
    
    /** @var ExceptionHandler | ErrorHandler */
    private $handler;
    
    /** @var ServerMessageInterface */
    private $response;
    
    /** @var bool */
    private $handled = false;
    
    /** @var \Throwable */
    private $throwable;

    /**
     * @param \Throwable $e
     * @param string $templateDirectory
     * @param bool $isDev
     */
    public function __construct(\Throwable $e, string $templateDirectory, private bool $isDev = false)
    {
        $this->throwable = $e;
        $this->templateDirectory = $templateDirectory . '/server';
        
        if ($e instanceof \Exception) {
            $this->handler = new ExceptionHandler();
        } else {
            $this->handler = new ErrorHandler();
        }
        
        $this->response = $this->handler->handle($e);
    }
    
    /**
     * @return void
     */
    public function processThrowable(): void
    {
        if ($this->handled) {
            return;
        }
        
        $this->handled = true;

        if ($this->isDev) {
            $e = $this->throwable;
        } else {
            $this->response->send();
        }
        
        require_once $this->getTemplateFile();
    }
    
    /**
     * @return string
     */
    private function getTemplateFile(): string
    {
        if ($this->isDev) {
            if (!$this->throwable instanceof HttpException) {
                return $this->templateDirectory . '/throwable.php';
            }
        }

        $template = sprintf('%d.html', $this->response->getStatusCode());
        if (!file_exists($this->templateDirectory . '/' . $template)) {
            $template = 'any.html';
        }
        
        return $this->templateDirectory . '/' . $template;
    }
}
