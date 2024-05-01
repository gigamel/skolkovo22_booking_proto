<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates;

use Booking\Base\AbstractModule;
use Modules\Skolkovo22\Estates\Service\EstateRepository;

abstract class AbstractEstatesModule extends AbstractModule
{
    /**
     * @param EstateRepository $repository
     */
    public function __construct(protected EstateRepository $repository)
    {
    }

    /**
     * @return string
     */
    protected function getModuleDir(): string
    {
        return __DIR__;
    }
}
