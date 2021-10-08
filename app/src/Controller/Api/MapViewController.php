<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Service\Api\MapViewService;
use Symfony\Component\HttpFoundation\JsonResponse;

class MapViewController
{
    /**
     * GET /map => Get the representation of the map
     *
     * @param MapViewService $service
     * 
     * @return JsonResponse
     */
    public function get(MapViewService $service): JsonResponse
    {
        return $service->getTheMapView();
    }
}
