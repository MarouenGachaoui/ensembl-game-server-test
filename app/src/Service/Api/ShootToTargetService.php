<?php

declare(strict_types=1);

namespace App\Service\Api;

use App\Entity\Player;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShootToTargetService extends BaseGameActionService
{

    private int $maxHitsToFishTheGame;
    private int $numberOfSidePositions;

    /**
     * Inject the binds from the configured env variables:
     *  - The maximum number of hits used to check if the game is finished.
     *  - The number of positions for one side of the map.
     *
     * @param int $maxHitsToFishTheGame
     * @param int $numberOfSidePositions
     * @required
     */
    public function setBinds(int $maxHitsToFishTheGame, int $numberOfSidePositions): void
    {
        $this->maxHitsToFishTheGame = $maxHitsToFishTheGame;
        $this->numberOfSidePositions = $numberOfSidePositions;
    }

    /**
     * Try one shoot to the target by the player.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function shootToTheTarget(Request $request): JsonResponse
    {
        $targetPosition = json_decode($request->getContent(), true);
        $x = $targetPosition['x'] ?? null;
        $y = $targetPosition['y'] ?? null;

        if (!($x && $y)) {
            $this->renderBadRequest('Position is required');
        }

        $this->init();
        $result = 'miss';

        if ($this->shooter->isTheTargetVisible($this->target) && $this->target->isSamePosition($x, $y)) {
            $this->target->setNumberOfHits($this->target->getNumberOfHits() + 1);
            $result = $this->target->getNumberOfHits() === $this->maxHitsToFishTheGame ? 'kill' : 'touch';
        }

        $this->moveTarget();
        $this->mapService->saveTheMap($this->map);

        return $this->renderResponse(['result' => $result], Response::HTTP_OK);
    }

    /**
     * Move the target randomly by one position.
     */
    private function moveTarget(): void
    {
        $actions = Player::getMoveActions();
        $randomAction = $actions[array_rand($actions)];

        if ($this->target->move($randomAction, $this->shooter, $this->numberOfSidePositions)) {
            return;
        }

        $this->moveTarget();
    }
}
