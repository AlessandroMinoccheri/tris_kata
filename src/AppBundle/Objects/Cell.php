<?php

namespace AppBundle\Objects;

class Cell {

    protected $position;

    public function setPosition(int $position)
    {
        if($position < 0 || $position > 9){
            throw new \RuntimeException('Negative Value aren\'t accepted');
        }

        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }
}
