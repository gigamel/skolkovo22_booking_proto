<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ReflectorInterface;
use App\Common\DI\ServicesProviderInterface;
use Modules\Skolkovo22\Estates\Service\EstateRepository;

final class ServicesProvider implements ServicesProviderInterface
{
    /**
     * @inheritDoc
     */
    public function provideServices(ContainerInterface $container, ReflectorInterface $reflector): void
    {
        $container->set(
            EstateRepository::class,
            $reflector->autowire(EstateRepository::class)
        );
    }
}
