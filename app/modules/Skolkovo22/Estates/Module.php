<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates;

use App\Common\Http\NotFoundException;
use Booking\Http\Response;
use Booking\Service\File\File;
use Modules\Skolkovo22\Estates\Service\Estate\Estate;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

class Module extends AbstractEstatesModule
{
    private const ATTR_PAGE_NUMBER = 'page_number';

    protected int $limit = 4;

    protected int $offset = 0;

    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     *
     * @throws NotFoundException
     */
    public function run(ClientMessageInterface $request): ServerMessageInterface
    {
        if ($request->hasAttribute(self::ATTR_PAGE_NUMBER)) {
            $pageNumber = (int)$request->getAttribute(self::ATTR_PAGE_NUMBER);

            $this->processPage($pageNumber);

            if (1 === $pageNumber) {
                return new Response(
                    '',
                    ServerMessageInterface::STATUS_MOVED_PERMANENTLY,
                    ['Location' => $this->router->getRouteUrl('estates')]
                );
            }

            $this->offset = ($pageNumber - 1) * $this->limit;
        }

        $estates = $this->repository->getList($this->limit, $this->offset);

        return $this->render(
            'list.php',
            [
                'estates' => $estates,
                'count' => $this->repository->getCount(),
                'limit' => $this->limit,
                'offset' => $this->offset,
                'router' => $this->router,
                'files' => $this->getFiles($estates),
                'converter' => $this->converter,
            ]
        );
    }

    /**
     * @param Estate[] $estates
     *
     * @return File[]
     */
    protected function getFiles(array $estates): array
    {
        $estatesIds = [];
        foreach ($estates as $estate) {
            if (in_array($estate->id, $estatesIds, true)) {
                continue;
            }

            $estatesIds[] = $estate->id;
        }

        $files = [];
        foreach ($this->fileRepository->getByEntityIds('estate', $estatesIds) as $file) {
            if (!is_array($files[$file->entity_id] ?? null)) {
                $files[$file->entity_id] = [];
            }

            $files[$file->entity_id][] = $file;
        }

        return $files;
    }

    /**
     * @param int $pageNumber
     *
     * @return void
     *
     * @throws NotFoundException
     */
    private function processPage(int $pageNumber): void
    {
        if (0 === $pageNumber) {
            throw new NotFoundException('Page Not Found');
        }

        if ($pageNumber > ceil($this->repository->getCount() / $this->limit)) {
            throw new NotFoundException('Estates Not Found');
        }
    }
}
