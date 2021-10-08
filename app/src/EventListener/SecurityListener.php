<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Service\Api\BaseGameService;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SecurityListener extends BaseGameService
{
    private int $maxHitsToFishTheGame;

    /**
     * Inject the binds from the configured env variables:
     *  - The maximum number of hits used to check if the game is finished.
     *
     * @param int $maxHitsToFishTheGame
     * @required
     */
    public function setBinds(int $maxHitsToFishTheGame): void
    {
        $this->maxHitsToFishTheGame = $maxHitsToFishTheGame;
    }

    /**
     * Control all the requests and decide to render 400 or 404 responses depending on the game's state
     *
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $this->mapService->setRedisMapKey($request);

        // There is no need to security control for the start endpoint
        if ($request->get('_route') === 'start') {
            return;
        }

        $map = $this->mapService->extractTheMap();

        // No map => render 404
        if ($map === null) {
            $this->renderNotFound('No game was found for this user');
        } elseif ($map->getTarget()->getNumberOfHits() === $this->maxHitsToFishTheGame) {
            // Game is finished => render 400
            $this->renderBadRequest('You are not able to apply this action because the game is finished');
        }
    }
}
