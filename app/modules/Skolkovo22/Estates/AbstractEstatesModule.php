<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates;

use App\Common\Routing\RouterInterface;
use Booking\Base\AbstractModule;
use Modules\Skolkovo22\Estates\Service\EstateRepository;

abstract class AbstractEstatesModule extends AbstractModule
{
    /**
     * @param RouterInterface $router
     * @param EstateRepository $repository
     */
    public function __construct(RouterInterface $router, protected EstateRepository $repository)
    {
        parent::__construct($router);
    }

    /**
     * @return string
     */
    protected function getModuleDir(): string
    {
        return __DIR__;
    }
}
