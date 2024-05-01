<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates\Pages;

use App\Common\Http\NotFoundException;
use Booking\Http\Response;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

final class Module extends \Modules\Skolkovo22\Estates\Module
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
                    'Location' => $this->router->getRouteUrl('estates'),
                ]
            );
        }
        
        $this->offset = ($pageNumber - 1) * $this->limit;

        return parent::run($request);
    }
}
