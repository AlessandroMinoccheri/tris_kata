<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Objects\Cell;

class Board
{
    protected $tiles;
    protected $winner;

    public function __construct()
    {
        $this->winner = '';
    }

    public function setValue(Request $request)
    {
        for ($i = 0; $i < 9; $i++) {
            $this->setCell($i, $request->request->get('cell_' . $i));
        }
    }

    public function setCell(int $position, $value)
    {
        if(null != $value){
            $this->tiles[$position] = $value;
        }
        else{
            $this->tiles[$position] = '0';
        }
    }

    public function getArrayResult() : array
    {
        return $this->tiles;
    }

    public function moveCpu()
    {
        $posRand = rand(0, 8);
        if ($this->tiles[$posRand] == '0') {
            $this->tiles[$posRand] = '2';
        }
        else{
            $this->moveCpu();
        }
    }

    private function checkHorizontal() :bool
    {
        if (($this->checkEqualsCell(0, 1, 2) == true)){
            $this->winner = $this->tiles[0];
            return true;
        }

        if (($this->checkEqualsCell(3, 4, 5) == true)){
            $this->winner = $this->tiles[3];
            return true;
        }

        if (($this->checkEqualsCell(6, 7, 8) == true)){
            $this->winner = $this->tiles[6];
            return true;
        }

        return false;
    }

    private function checkEqualsCell(int $positionA, int $positionB, int $positionC)
    {
        if (($this->tiles[$positionA] == $this->tiles[$positionB]) && ( $this->tiles[$positionA]== $this->tiles[$positionC]) && ($this->tiles[$positionA] != '0')) {
            return true;
        }

        return false;
    }

    private function checkVertical() :bool
    {
        if (($this->checkEqualsCell(0, 3, 6) == true)){
            $this->winner = $this->tiles[0];
            return true;
        }

        if (($this->checkEqualsCell(1, 4, 7) == true)){
            $this->winner = $this->tiles[1];
            return true;
        }

        if (($this->checkEqualsCell(2, 5, 8) == true)){
            $this->winner = $this->tiles[2];
            return true;
        }

        return false;
    }

    public function isGameFinished() : bool
    {
        if ($this->checkHorizontal()) {
            return true;
        }

        if ($this->checkVertical()) {
            return true;
        }

        return false;
    }

    public function getWinner() : string
    {
        return  $this->winner;
    }
}
