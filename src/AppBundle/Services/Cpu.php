<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Board;
use AppBundle\Services\MoveCalculator;

class Cpu
{
    const EMPTY_CELL = '0';
    const PLAYER_CELL = '1';
    const CPU_CELL = '2';

    protected $board;
    protected $level;

    public function __construct()
    {

    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel(string $level)
    {
        $this->level = $level;
    }

    public function setBoard(Board $board)
    {
        $this->board = $board;
    }

    public function moveCpu()
    {
        $moveCalculator = new MoveCalculator($this->board);

        if ($this->getLevel() == 'easy') {
            $moveCalculator->moveRandom();
        } else {
            $moveCalculator->calculateNextMove();
        }
    }
}
