<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Board;

class Cpu
{
    protected $board;
    protected $level;

    public function __construct()
    {

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
        if ($this->level == 'easy') {
            $this->moveRandom();
        }
    }

    private function moveRandom()
    {
        $posRand = rand(0, 8);

        if (
            ($this->board->getCellValue($posRand) == '0') ||
            ($this->board->getCellValue($posRand) == null)) {
            $this->board->setCell($posRand, '2');
        } else {
            $this->moveRandom();
        }
    }
}
