<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Service\Api\ShootToTargetService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ShootToTargetController
{
    /**
     * POST /shoot => try one shoot by the player.
     *
     * @param Request $request
     * @param ShootToTargetService $service
     *
     * @return JsonResponse
     */
    public function shoot(Request $request, ShootToTargetService $service): JsonResponse
    {
        return $service->shootToTheTarget($request);
    }
}
