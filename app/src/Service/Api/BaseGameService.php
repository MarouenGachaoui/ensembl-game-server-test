<?php

declare(strict_types=1);

namespace App\Service\Api;

abstract class BaseGameService
{
    protected MapService $mapService;

    /**
     * Constructor.
     *
     * @param MapService $mapService
     */
    public function __construct(MapService $mapService)
    {
        $this->mapService = $mapService;
    }
}
