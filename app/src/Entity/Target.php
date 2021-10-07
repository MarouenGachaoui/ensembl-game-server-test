<?php

namespace App\Entity;

class Target extends Player
{
    private int $numberOfHits = 0;

    /**
     * @return int
     */
    public function getNumberOfHits(): int
    {
        return $this->numberOfHits;
    }

    public function setNumberOfHits(int $numberOfHits): self
    {
       $this->numberOfHits = $numberOfHits;

       return $this;
    }
}
