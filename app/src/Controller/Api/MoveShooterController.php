<?php

namespace App\Controller\Api;

use App\Service\Api\MoveShooterService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MoveShooterController
{
    /**
     * POST /move => move the shooter by one position.
     *
     * @param Request $request
     * @param MoveShooterService $service
     *
     * @return JsonResponse
     */
    public  function move(Request $request, MoveShooterService $service): JsonResponse
    {
        return $service->moveTheShooter($request);
    }
}
