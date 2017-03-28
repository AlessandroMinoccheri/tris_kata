<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Objects\Cell;
use AppBundle\Objects\PossibleCombinations;

class Board
{
    const EMPTY_CELL = '0';
    const PLAYER_CELL = '1';
    const CPU_CELL = '2';

    protected $tiles;
    protected $winner;
    private $checker;

    public function __construct(Checker $checker)
    {
        $this->winner = '';
        $this->checker = $checker;
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
            $this->tiles[$position] = self::EMPTY_CELL;
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

    public function getPositionInArrayByValue(int $value) : array
    {
        $position = [];
        for ($i = 0; $i <= 8; $i++) {
            if ($this->getCellValue($i) == $value) {
                array_push($position, $i);
            }
        }

        return $position;
    }

    private function checkCellCombination(
        int $positionA,
        int $positionB,
        int $positionC
    ) {
        $isCellsEqual = $this->checker->checkIfCellEquals(
            $positionA,
            $positionB,
            $positionC,
            $this->tiles
        );

        if (($isCellsEqual == true)){
            $this->winner = $this->tiles[$positionA];
            return true;
        }

        return false;
    }

    public function isGameFinished() : bool
    {
        if ($this->checkHorizontalTris() ||
            $this->checkVerticalTris() ||
            $this->checkObliqueTris()
        ) {
            return true;
        }

        return false;
    }

    public function getWinner() : string
    {
        return  $this->winner;
    }

    public function atLeastTwoEqualsPosition (
        array $combination,
        $value
    ) : bool {

        $first = $this->getCellValue($combination[0]);
        $second = $this->getCellValue($combination[1]);
        $third = $this->getCellValue($combination[2]);

        if (
            (($first == $second) && ($first == $value)) ||
            (($second == $third) && ($second == $value)) ||
            (($first == $third) && ($first == $value))
        ) {
            return true;
        }

        return false;
    }

    public function getPartialTrisPosition (
        int $position,
        int $value
    ) {
        $possibleCombinations = PossibleCombinations::fromPosition(
            $position
        );

        foreach ($possibleCombinations->getCombinations() as $combination) {
            if (
                $this->atLeastTwoEqualsPosition($combination, $value) &&
                $this->atLeastOneEmptyCell($combination)
            ) {
                return $this->getEmptyCellFromCombination($combination);
            }
        }

        return false;
    }

    private function atLeastOneEmptyCell(array $combinations)
    {
        foreach ($combinations as $combination) {
            if ($this->getCellValue($combination) == self::EMPTY_CELL) {
                return true;
            }
        }

        return false;
    }

    public function getEmptyCellFromCombination(array $combination)
    {
        for ($i = 0; $i < count($combination); $i++) {
            if ($this->isCellEmpty($combination[$i])) {
                return $combination[$i];
            }
        }
    }

    public function isCellEmpty($position) : bool
    {
        if ($this->getCellValue($position) == self::EMPTY_CELL ||
            $this->getCellValue($position) == null) {
            return true;
        }

        return false;
    }

    public function checkHorizontalTris() :bool
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

    public function checkVerticalTris() :bool
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

    public function checkObliqueTris() :bool
    {
        if (
            $this->checkCellCombination(0, 4, 8) ||
            $this->checkCellCombination(2, 4, 6)
        ) {
            return true;
        }

        return false;
    }

    public function getAllEmptyCell() : array
    {
        $emptyCell = [];

        for ($i = 0; $i <= 8; $i++) {
            if ($this->isCellEmpty($i)) {
                array_push($emptyCell, $i);
            }
        }

        return $emptyCell;
    }
}
