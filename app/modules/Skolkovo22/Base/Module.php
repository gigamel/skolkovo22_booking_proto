<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Base;

use Booking\Base\AbstractModule;
use Booking\Http\Response;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

final class Module extends AbstractModule
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function run(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render('home.php');
    }
}
