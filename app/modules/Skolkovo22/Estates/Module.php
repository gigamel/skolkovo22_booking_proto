<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates;

use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

class Module extends AbstractEstatesModule
{
    protected int $limit = 3;

    protected int $offset = 0;

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function run(ClientMessageInterface $request): ServerMessageInterface
    {
        return $this->render(
            'view/list.php',
            [
                'estates' => $this->repository->getList($this->limit, $this->offset),
                'count' => $this->repository->getCount(),
                'limit' => $this->limit,
                'offset' => $this->offset,
            ]
        );
    }
}
