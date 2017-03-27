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

    public function moveRandom()
    {
        $posRand = rand(0, 8);

        if ($this->board->isCellEmpty($posRand)) {
            $this->board->setCell($posRand, self::CPU_CELL);
            return $posRand;
        } else {
            $this->moveRandom();
        }
    }

    public function calculateNextMove()
    {
        $nextMoveDefense = $this->moveToPartialTris(
            self::PLAYER_CELL,
            self::CPU_CELL
        );

        if ($nextMoveDefense) {
            return $nextMoveDefense;
        }

        $nextMoveOffense = $this->moveToPartialTris(
            self::CPU_CELL,
            self::PLAYER_CELL
        );

        if ($nextMoveOffense) {
            return $nextMoveOffense;
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
