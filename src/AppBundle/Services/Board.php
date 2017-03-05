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

    public function setValueFromRequest(Request $request)
    {
        for ($i = 0; $i < 9; $i++) {
            $this->setCell($i, $request->request->get('cell_' . $i));
        }
    }

    public function setCell(int $position, $value)
    {
        if (null != $value) {
            $this->tiles[$position] = $value;
        } else {
            $this->tiles[$position] = '0';
        }
    }

    public function getCellValue(int $position) : string
    {
        return $this->tiles[$position];
    }

    public function getArrayResult() : array
    {
        return $this->tiles;
    }

    private function checkEqualsCell(int $positionA, int $positionB, int $positionC) :bool
    {
        if (
            $this->tiles[$positionA] == $this->tiles[$positionB] &&
            $this->tiles[$positionA] == $this->tiles[$positionC] &&
            $this->tiles[$positionA] != '0'
        ) {
            return true;
        }

        return false;
    }

    private function checkCellCombination(int $positionA, int $positionB, int $positionC)
    {
        if (($this->checkEqualsCell($positionA, $positionB, $positionC) == true)){
            $this->winner = $this->tiles[$positionA];
            return true;
        }

        return false;
    }

    private function checkHorizontalTris() :bool
    {
        if (
            $this->checkCellCombination(0, 1, 2) ||
            $this->checkCellCombination(3, 4, 5) ||
            $this->checkCellCombination(6, 7, 8)
        ) {
            return true;
        }

        return false;
    }

    private function checkVerticalTris() :bool
    {
        if (
            $this->checkCellCombination(0, 3, 6) ||
            $this->checkCellCombination(1, 4, 7) ||
            $this->checkCellCombination(2, 5, 8)
        ) {
            return true;
        }

        return false;
    }

    private function checkObliqueTris() :bool
    {
        if (
            $this->checkCellCombination(0, 4, 8) ||
            $this->checkCellCombination(2, 4, 6)
        ) {
            return true;
        }

        return false;
    }

    public function isGameFinished() : bool
    {
        if ($this->checkHorizontalTris() || $this->checkVerticalTris() || $this->checkObliqueTris()) {
            return true;
        }

        return false;
    }

    public function getWinner() : string
    {
        return  $this->winner;
    }
}
