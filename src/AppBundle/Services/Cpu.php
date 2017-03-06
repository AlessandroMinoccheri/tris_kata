<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Board;

class Cpu
{
    protected $board;

    public function __construct()
    {

    }

    public function setBoard(Board $board)
    {
        $this->board = $board;
    }

    public function moveCpu()
    {
        $posRand = rand(0, 8);

        if ($this->board->getCellValue($posRand) == '0') {
            $this->board->setCell($posRand, '2');
        } else {
            $this->moveCpu();
        }
    }
}
