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

    public function getCellValue(int $position)
    {
        return $this->tiles[$position];
    }

    public function getArrayResult() : array
    {
        return $this->tiles;
    }

    public function getHumansPositionInArray() : array
    {
        $posHuman = [];
        for ($i = 0; $i <= 8; $i++) {
            if ($this->getCellValue($i) == '1') {
                array_push($posHuman, $i);
            }
        }

        return $posHuman;
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

    public function checkPartialPositionFromPositionAndValue (
        int $position,
        $value
    ) : bool {
        $possibleCombinations = $this->getAllPossibleCombinationFromPosition(
            $position
        );

        foreach ($possibleCombinations as $combination) {
            if ($this->atLeastTwoEqualsPosition($combination, $value)) {
                return true;
            }
        }

        return false;
    }

    private function getAllPossibleCombinationFromPosition($position) : array
    {
        $possibleCombinations = [];

        switch ($position) {
            case '0':   array_push($possibleCombinations, [0, 1, 2] );
                        array_push($possibleCombinations, [0, 3, 6] );
                        array_push($possibleCombinations, [0, 4, 8] );
                        break;
            case '1':   array_push($possibleCombinations, [0, 1, 2] );
                        array_push($possibleCombinations, [1, 4, 7] );
                        break;
            case '2':   array_push($possibleCombinations, [0, 1, 2] );
                        array_push($possibleCombinations, [2, 5, 8] );
                        array_push($possibleCombinations, [2, 4, 6] );
                        break;
            case '3':   array_push($possibleCombinations, [3, 4, 5] );
                        array_push($possibleCombinations, [0, 3, 6] );
                        break;
            case '4':   array_push($possibleCombinations, [3, 4, 5] );
                        array_push($possibleCombinations, [1, 4, 7] );
                        array_push($possibleCombinations, [0, 4, 8] );
                        array_push($possibleCombinations, [2, 4, 6] );
                        break;
            case '5':   array_push($possibleCombinations, [3, 4, 5] );
                        array_push($possibleCombinations, [2, 5, 8] );
                        break;
            case '6':   array_push($possibleCombinations, [6, 7, 8] );
                        array_push($possibleCombinations, [0, 3, 8] );
                        array_push($possibleCombinations, [2, 4, 6] );
                        break;
            case '7':   array_push($possibleCombinations, [6, 7, 8] );
                        array_push($possibleCombinations, [1, 4, 7] );
                        break;
            case '8':   array_push($possibleCombinations, [6, 7, 8] );
                        array_push($possibleCombinations, [2, 5, 8] );
                        array_push($possibleCombinations, [0, 4, 8] );
                        break;


        }

        return $possibleCombinations;
    }

    private function atLeastTwoEqualsPosition (
        array $combination,
        $value
    ) : bool {
        return $combination[0] &&
        ($combination[1] || $combination[2]) ||
        ($combination[1] && $combination[2]);
    }
}
