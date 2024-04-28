<?php

declare(strict_types=1);

namespace Booking\Http;

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
    
    /**
     * @param \Throwable $e
     * @param string $templateDirectory
     */
    public function __construct(\Throwable $e, string $templateDirectory)
    {
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
        
        $this->response->send();
        $this->handled = true;
        
        require_once $this->getTemplateFile();
    }
    
    /**
     * @return string
     */
    private function getTemplateFile(): string
    {
        $template = sprintf('%d.html', $this->response->getStatusCode());
        if (!file_exists($this->templateDirectory . '/' . $template)) {
            $template = 'any.html';
        }
        
        return $this->templateDirectory . '/' . $template;
    }
}
