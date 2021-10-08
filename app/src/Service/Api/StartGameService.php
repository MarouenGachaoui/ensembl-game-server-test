<?php

declare(strict_types=1);

namespace App\Service\Api;

use App\Entity\Map;
use App\Entity\Shooter;
use App\Entity\Target;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StartGameService extends BaseGameService
{
    private int $numberOfSidePositions;

    /**
     * Inject the binds from the configured env variables:
     *  - The number of positions for one side of the map.
     *  - The lifetime of the game in seconds. After this delay, the redis item representing the map will expire.
     *
     * @param int $numberOfSidePositions
     * @required
     */
    public function setBinds(int $numberOfSidePositions): void
    {
        $this->numberOfSidePositions = $numberOfSidePositions;
    }

    /**
     * Start a new map and save it in redis.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function startTheGame(): JsonResponse
    {
        $sideMiddlePosition = (int) round($this->numberOfSidePositions / 2);
        $shooter = new Shooter($sideMiddlePosition, $sideMiddlePosition);
        $target = $this->createNewTarget($shooter);
        $this->mapService->saveTheMap(new Map($shooter, $target, $this->numberOfSidePositions));

        return $this->renderResponse('Game started', Response::HTTP_CREATED);
    }

    /**
     * Create one target player with a random position that must be different from the shooter's one.
     *
     * @param Shooter $shooter
     *
     * @return Target
     * @throws \Exception
     */
    private function createNewTarget(Shooter $shooter): Target
    {
        $target = new Target(random_int(1, $this->numberOfSidePositions), random_int(1, $this->numberOfSidePositions));

        if (!$target->isSamePosition($shooter->getX(), $shooter->getY())) {
            return $target;
        }

        return $this->createNewTarget($shooter);
    }
}
