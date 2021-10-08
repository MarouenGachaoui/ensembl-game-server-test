<?php

declare(strict_types=1);

namespace App\Entity;

class Map
{
    private int $numberOfSidePositions;
    private Shooter $shooter;
    private Target $target;

    /**
     * Constructor.
     *
     * @param Shooter $shooter
     * @param Target $target
     * @param int $numberOfSidePositions
     */
    public function __construct(Shooter $shooter, Target $target, int $numberOfSidePositions)
    {
        $this->shooter = $shooter;
        $this->target = $target;
        $this->numberOfSidePositions = $numberOfSidePositions;
    }

    /**
     * @return int
     */
    public function getNumberOfSidePositions(): int
    {
        return $this->numberOfSidePositions;
    }

    /**
     * @param int $numberOfSidePositions
     *
     * @return Map
     */
    public function setNumberOfSidePositions(int $numberOfSidePositions): self
    {
        $this->numberOfSidePositions = $numberOfSidePositions;

        return $this;
    }

    /**
     * @return Shooter
     */
    public function getShooter(): Shooter
    {
        return $this->shooter;
    }

    /**
     * @param Shooter $shooter
     *
     * @return Map
     */
    public function setShooter(Shooter $shooter): self
    {
        $this->shooter = $shooter;

        return $this;
    }

    /**
     * @return Target
     */
    public function getTarget(): Target
    {
        return $this->target;
    }

    /**
     * @param Target $target
     *
     * @return Map
     */
    public function setTarget(Target $target): self
    {
        $this->target = $target;

        return $this;
    }
}
