<?php

namespace Tests\AppBundle\Objects;

use AppBundle\Objects\PossibleCombinations;
use PHPUnit\Framework\TestCase;

class PossibleCombinationsObjectTest extends TestCase
{
    public function testGetPossibleCombinations()
    {
        $randomPosition = rand(0, 8);
        $possibleCombinations = PossibleCombinations::fromPosition(
            $randomPosition
        );

        $this->assertGreaterThan(0, count($possibleCombinations));
        $this->assertGreaterThan(0, count($possibleCombinations->getCombinations()));
    }
}
