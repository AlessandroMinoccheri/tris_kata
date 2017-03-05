<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Board;

class Cpu
{
    protected $board;

    private function __construct(Board $board)
    {
        $this->board = $board;
    }

    public static function createCpuWithBoard(Board $board) : Cpu
    {
        return new Cpu($board);
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
