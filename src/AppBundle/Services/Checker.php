<?php

namespace AppBundle\Services;

class Checker
{
    protected $board;

    public function __construct()
    {

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

    public function atLeastTwoEqualsPosition (
        array $combination,
        $value
    ) : bool {
        return
            (($combination[0] == $combination[1]) && ($combination[0] == $value)) ||
            (($combination[1] == $combination[2]) && ($combination[1] == $value)) ||
            (($combination[0] == $combination[2]) && ($combination[0] == $value));
    }
}
