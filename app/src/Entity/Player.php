<?php

namespace App\Entity;

abstract class Player
{
    public const MOVE_UP = 'up';
    public const MOVE_DOWN = 'down';
    public const MOVE_LEFT = 'left';
    public const MOVE_RIGHT = 'right';

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
     * Check the position with another one and return if it's the same.
     *
     * @param int $x
     * @param int $y
     *
     * @return bool
     */
    public function isSamePosition(int $x, int $y): bool
    {
        return $this->x === $x && $this->y === $y;
    }

    /**
     * Move the player by one position.
     * Do not move if the next position:
     *  - is outside the limit
     *  - corresponds to the position of the other player
     *
     * @param string $action
     * @param Player $player
     * @param int $limit
     *
     * @return bool
     */
    public function move(string $action, Player $player, int $limit): bool
    {
        $x = $this->x;
        $y = $this->y;

        switch ($action) {
            case self::MOVE_UP:
                $y --;
                break;
            case self::MOVE_DOWN:
                $y ++;
                break;
            case self::MOVE_LEFT:
                $x --;
                break;
            case self::MOVE_RIGHT:
                $x ++;
                break;
            default:
                break;
        }

        if ($x > $limit || $y > $limit || $x < 1 || $y < 1 || $player->isSamePosition($x, $y)) {
            return false;
        }

        $this->x = $x;
        $this->y = $y;

        return true;
    }

    /**
     * Render the position as array.
     *
     * @return int[]
     */
    public function getPositionAsArray(): array
    {
        return ['x' => $this->getX(), 'y' => $this->getY()];
    }
}
