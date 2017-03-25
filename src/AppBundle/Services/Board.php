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

    public function getHumansPositionInArray() : array
    {
        $posHuman = [];
        for ($i = 0; $i <= 8; $i++) {
            if ($this->getCellValue($i) == self::PLAYER_CELL) {
                array_push($posHuman, $i);
            }
        }

        return $posHuman;
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
        if ($this->checker->checkHorizontalTris() ||
            $this->checker->checkVerticalTris() ||
            $this->checker->checkObliqueTris()
        ) {
            return true;
        }

        return false;
    }

    public function getWinner() : string
    {
        return  $this->winner;
    }

    public function existPartialTris (
        int $position,
        $value
    ) : bool {
        $possibleCombinations = PossibleCombinations::fromPosition(
            $position
        );

        foreach ($possibleCombinations->getCombinations() as $combination) {
            if (
                $this->checker->atLeastTwoEqualsPosition($combination, $value) &&
                $this->checker->atLeastOneEmptyCell($combination)
            ) {
                return true;
            }
        }

        return false;
    }
}
