<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates;

use Booking\Base\AbstractModule;
use Booking\Service\File\FileRepository;
use Modules\Skolkovo22\Estates\Service\EstateRepository;

abstract class AbstractEstatesModule extends AbstractModule
{
    /**
     * @param EstateRepository $repository
     * @param FileRepository $fileRepository
     */
    public function __construct(
        protected EstateRepository $repository,
        protected FileRepository $fileRepository
    ) {
    }

    /**
     * @return string
     */
    protected function getModuleDir(): string
    {
        return __DIR__;
    }
}
