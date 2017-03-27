<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Services\Board;
use AppBundle\Services\Checker;

class CheckerServiceTest extends WebTestCase
{
    public function testNotCellsEqual()
    {
        $checker = new Checker();
        $firstValue = rand(0,100);
        $secondValue = rand(0,100);
        $thirdValue = rand(0,100);

        $arrayRandom = [$firstValue, $secondValue, $thirdValue];

        $cellsEqual = $checker->checkIfCellEquals(0, 1, 2, $arrayRandom);
        $this->assertFalse($cellsEqual);
    }

    public function testCellsEqual()
    {
        $checker = new Checker();
        $value = rand(0,100);

        $arrayRandom = [$value, $value, $value];

        $cellsEqual = $checker->checkIfCellEquals(0, 1, 2, $arrayRandom);
        $this->assertTrue($cellsEqual);
    }
}
