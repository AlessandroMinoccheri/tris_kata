<?php

namespace AppBundle\Objects;

class Cell {

    protected $position;
    protected $status;

    public function setPosition(int $position)
    {
        if($position < 0 || $position >= 9){
            throw new \RuntimeException('Position out of range');
        }

        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setStatus(int $status)
    {
        if($status < 0 || $status > 2){
            throw new \RuntimeException('Value out of range');
        }

        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
