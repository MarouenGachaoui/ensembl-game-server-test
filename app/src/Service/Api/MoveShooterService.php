<?php

declare(strict_types=1);

namespace App\Service\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class MoveShooterService extends BaseGameService
{
    /**
     * Move the shooter depending on the requested action.
     * If the target is visible, render its position in the response.
     * Here, the visibility distance is not configurable, so that it takes the default value used inside the shooter's isTheTargetVisible function.
     * If we need to make this distance configurable, we can bind an env variable to this service and pass it as argument of the shooter's isTheTargetVisible function.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function moveTheShooter(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $action = $content["action"] ?? null;

        if (!$action) {
            throw new BadRequestHttpException('Action is required');
        }

        $map = $this->mapService->getMap();
        $shooter = $map->getShooter();
        $target = $map->getTarget();

        if ($shooter->move($action, $target, $map->getNumberOfSidePositions())) {
            // Save the map only if the shooter's position changed
            $this->mapService->saveTheMap($map);
        }

        return new JsonResponse([
            'position' => $shooter->getPositionAsArray(),
            'target' => $shooter->isTheTargetVisible($target) ? $target->getPositionAsArray() : null
        ], Response::HTTP_CREATED);
    }
}
