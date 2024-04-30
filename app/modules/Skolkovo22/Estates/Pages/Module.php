<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates\Pages;

use App\Common\Http\NotFoundException;
use Booking\Http\Response;
use Modules\Skolkovo22\Estates\AbstractEstatesModule;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

final class Module extends AbstractEstatesModule
{
    private const
        ATTR_PAGE_NUMBER = 'page_number',
        ATTR_PAGE_ATTR_NAME = 'page_attr_name'
    ;
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     *
     * @throws NotFoundException
     */
    public function run(ClientMessageInterface $request): ServerMessageInterface
    {
        $pageNumber = (int)$request->getAttribute(self::ATTR_PAGE_NUMBER);
        if (0 === $pageNumber) {
            throw new NotFoundException('Page Not Found');
        }
        
        if (1 === $pageNumber) {
            return new Response(
                '',
                ServerMessageInterface::STATUS_MOVED_PERMANENTLY,
                [
                    'Location' => $this->getRedirectStartPage($request),
                ]
            );
        }
        
        return new Response('Estates ' . $request->getAttribute('page_number') . ' num');
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return string
     */
    private function getRedirectStartPage(ClientMessageInterface $request): string
    {
        return str_replace(
            sprintf(
                '%s/%s',
                $request->getAttribute(self::ATTR_PAGE_ATTR_NAME),
                $request->getAttribute(self::ATTR_PAGE_NUMBER)
            ),
            '',
            $request->getPath()
        );
    }
}
