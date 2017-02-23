<?php

namespace AppBundle\Objects;

class Cell {

    protected $position;

    public function setPosition($position)
    {
        if($position >= 1 && $position <= 9)
        {
            $this->position = $position;
        }

        throw new \RuntimeException();

    }

    public function getPosition()
    {
        return $this->position;
    }
}
