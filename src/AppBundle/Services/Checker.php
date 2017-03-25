<?php

namespace AppBundle\Services;

class Checker
{
    protected $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function checkIfCellEquals(
        int $positionA,
        int $positionB,
        int $positionC,
        array $tiles
    ) :bool {
        if (
            $tiles[$positionA] == $tiles[$positionB] &&
            $tiles[$positionA] == $tiles[$positionC] &&
            $tiles[$positionA] != '0'
        ) {
            return true;
        }

        return false;
    }

    public function atLeastOneEmptyCell(array $combination)
    {
        if ($this->isCellEmpty($combination[0]) ||
            $this->isCellEmpty($combination[1]) ||
            $this->isCellEmpty($combination[2])
        ) {
            return true;
        }

        return false;
    }

    public function atLeastTwoEqualsPosition (
        array $combination,
        $value
    ) : bool {
        return $combination[0] &&
        ($combination[1] || $combination[2]) ||
        ($combination[1] && $combination[2]);
    }

    private function isCellEmpty($position) : bool
    {
        if ($this->board->getCellValue($position) == self::EMPTY_CELL ||
            $this->board->getCellValue($position) == null) {
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
}
