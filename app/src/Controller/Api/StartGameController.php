<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Service\Api\StartGameService;
use Symfony\Component\HttpFoundation\JsonResponse;

class StartGameController
{
    /**
     * POST /start => start one new game
     *
     * @param StartGameService $service
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function start(StartGameService $service): JsonResponse
    {
        return $service->startTheGame();
    }
}
