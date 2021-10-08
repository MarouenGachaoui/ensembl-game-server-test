<?php

declare(strict_types=1);

namespace App\Service\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MapViewService extends BaseGameActionService
{
    /**
     * Get the representation of the map as a json array with n lines. Each line is a string of n values representing the positions.
     * Values are :
     *  - 0 to model and empty position
     *  - S to model the position of the shouter
     *  - T to model the position of the target
     *
     * @return JsonResponse
     */
    public function getTheMapView(): JsonResponse
    {
        $this->init();
        $view = [];

        for ($y = 1; $y <= $this->map->getNumberOfSidePositions(); $y ++) {
            $view[$y] = null;

            for ($x = 1; $x <= $this->map->getNumberOfSidePositions(); $x ++) {
                if ($this->shooter->isSamePosition($x, $y)) {
                    $view[$y] .= 'S';
                } elseif ($this->target->isSamePosition($x, $y)) {
                    $view[$y] .= 'T';
                } else {
                    $view[$y] .= '0';
                }
            }
        }

        return $this->renderResponse($view, Response::HTTP_OK);

    }
}
