<?php

namespace App\Entity;

abstract class Player
{
    /**
     * @var int [the x side position of the player]
     */
    protected int $x;

    /**
     * @var int [the y side position of the player]
     */
    protected int $y;

    /**
     * Constructor.
     *
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     *
     * @return $this
     */
    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     *
     * @return $this
     */
    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Check the position with another player and return it's the same.
     *
     * @param Player $player
     *
     * @return bool
     */
    public function isSamePosition(Player $player): bool
    {
        return $this->x === $player->getX() && $this->y === $player->getY();
    }
}
