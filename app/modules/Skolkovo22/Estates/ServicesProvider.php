<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ServicesProviderInterface;
use App\Common\Storage\ConnectionInterface;
use Modules\Skolkovo22\Estates\Service\EstatesRepository;

final class ServicesProvider implements ServicesProviderInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    public function provideServices(ContainerInterface $container): void
    {
        $container->set(
            EstatesRepository::class,
            new EstatesRepository($container->get(ConnectionInterface::class))
        );
    }
}
