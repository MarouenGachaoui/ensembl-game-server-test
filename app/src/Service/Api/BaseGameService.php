<?php

declare(strict_types=1);

namespace App\Service\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * Render one bad request exception.
     *
     * @param string $message
     */
    protected function renderBadRequest(string $message): void
    {
        throw new BadRequestHttpException($message);
    }

    /**
     * Render one not found exception.
     *
     * @param string $message
     */
    protected function renderNotFound(string $message): void
    {
        throw new NotFoundHttpException($message);
    }

    /**
     * Render the http response as json.
     *
     * @param $message
     * @param int $code
     *
     * @return JsonResponse
     */
    protected function renderResponse($message, int $code): JsonResponse
    {
        return new JsonResponse($message, $code);
    }
}
