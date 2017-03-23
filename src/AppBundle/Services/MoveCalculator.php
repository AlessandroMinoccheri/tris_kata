<?php

namespace AppBundle\Services;

class MoveCalculator
{
    const EMPTY_CELL = '0';
    const PLAYER_CELL = '1';
    const CPU_CELL = '2';

    protected $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function moveRandom()
    {
        $posRand = rand(0, 8);

        if ($this->board->isCellEmpty($posRand)) {
            $this->board->setCell($posRand, self::CPU_CELL);
        } else {
            $this->moveRandom();
        }
    }

    public function calculateNextMove()
    {
        $posHuman = $this->board->getHumansPositionInArray();

        foreach ($posHuman as $position) {
            if ($this->board->existPartialPositionFromPositionAndValue(
                $position,
                '1'
            )) {
                //return $this->getPositionPartialTris();
            }
        }

        return $this->moveRandom();
    }
}
