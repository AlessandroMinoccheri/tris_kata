<?php

namespace AppBundle\Services;

class Checker
{
    public function checkIfCellEquals(
        int $positionA,
        int $positionB,
        int $positionC,
        $tiles
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
}
