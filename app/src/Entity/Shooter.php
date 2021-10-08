<?php

declare(strict_types=1);

namespace App\Entity;

class Shooter extends Player
{
    /**
     * Check if the target is visible by the shooter depending on the given minimum distance (default to 2).
     * Here we handle the case where the target is situated on the diagonal visibility of the shooter (the distance between x and y is the same).
     *
     * @param Target $target
     * @param int $minimumDistance
     *
     * @return bool
     */
    public function isTheTargetVisible(Target $target, int $minimumDistance = 2): bool
    {
        $xDist = abs($this->x - $target->getX());
        $yDist = abs($this->y - $target->getY());

        return ($xDist <= $minimumDistance + 1 && ($yDist === 0 || $yDist === $xDist)) ||
            ($yDist <= $minimumDistance + 1 && $xDist === 0);
    }
}
