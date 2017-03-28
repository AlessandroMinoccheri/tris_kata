<?php

namespace AppBundle\Services;

class MoveCalculator
{
    const EMPTY_CELL = '0';
    const PLAYER_CELL = '1';
    const CPU_CELL = '2';

    protected $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function moveRandom() : int
    {
        $emptyCell = $this->board->getAllEmptyCell();
        $posRand = rand(0, count($emptyCell));
        $this->board->setCell($emptyCell[$posRand], self::CPU_CELL);

        return $emptyCell[$posRand];
    }

    public function calculateNextMove()
    {
        $nextMoveOffense = $this->moveToPartialTris(
            self::CPU_CELL,
            self::PLAYER_CELL
        );

        if ($nextMoveOffense) {
            $this->board->setCell($nextMoveOffense, self::CPU_CELL);
            return $nextMoveOffense;
        }

        $nextMoveDefense = $this->moveToPartialTris(
            self::PLAYER_CELL,
            self::CPU_CELL
        );

        if ($nextMoveDefense) {
            $this->board->setCell($nextMoveDefense, self::CPU_CELL);
            return $nextMoveDefense;
        }

        return $this->moveRandom();
    }

    private function moveToPartialTris(int $valueGet, int $valueSet)
    {
        $positions = $this->board->getPositionInArrayByValue($valueGet);
        foreach ($positions as $position) {
            $possibleNextMove = $this->board->getPartialTrisPosition(
                $position,
                $valueGet
            );

            if ($possibleNextMove) {
                $this->board->setCell($possibleNextMove, $valueSet);
                return $possibleNextMove;
            }
        }

        return false;
    }
}
