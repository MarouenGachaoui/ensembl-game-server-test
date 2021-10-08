<?php

declare(strict_types=1);

namespace App\Service\Api;

use App\Entity\Map;
use App\Entity\Shooter;
use App\Entity\Target;

abstract class BaseGameActionService extends BaseGameService
{
    protected Map $map;
    protected Shooter $shooter;
    protected Target $target;

    /**
     * Init the map and the players from the map service.
     */
    protected function init(): void
    {
        $this->map = $this->mapService->getMap();
        $this->shooter = $this->map->getShooter();
        $this->target = $this->map->getTarget();
    }

}
