<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates\Estate;

use App\Common\Http\NotFoundException;
use Modules\Skolkovo22\Estates\AbstractEstatesModule;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

final class Module extends AbstractEstatesModule
{
    private const ATTR_ENTITY_ID = 'entity_id';
    
    /**
    * @param ClientMessageInterface $request
    *
    * @return ServerMessageInterface
    *
    * @throws NotFoundException
    */
    public function run(ClientMessageInterface $request): ServerMessageInterface
    {
        $estate = $this->repository->getById((int)$request->getAttribute(self::ATTR_ENTITY_ID));
        if (is_null($estate)) {
            throw new NotFoundException('Estate Not Found');
        }
        
        return $this->render(
            'card.php',
            [
                'estate' => $estate,
                'router' => $this->router,
            ]
        );
    }
}
