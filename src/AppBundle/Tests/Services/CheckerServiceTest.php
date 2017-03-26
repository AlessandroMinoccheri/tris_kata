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

    public function testAtLeastTwoEqualsPositionTrue()
    {
        $checker = new Checker();
        $valueEqual = rand(0, 100);
        $valueDifferent = rand(101, 200);

        $arrayRandom = [$valueEqual, $valueEqual, $valueDifferent];
        $atLeastTwoEquals = $checker->atLeastTwoEqualsPosition(
            $arrayRandom,
            $valueEqual
        );

        $this->assertTrue($atLeastTwoEquals);
    }

    public function testAtLeastTwoEqualsPositionFalse()
    {
        $checker = new Checker();
        $firstValue = rand(0, 100);
        $secondValue = rand(200, 300);
        $thirdValue = rand(300, 400);

        $arrayRandom = [$firstValue, $secondValue, $thirdValue];

        $atLeastTwoEquals = $checker->atLeastTwoEqualsPosition(
            $arrayRandom,
            $firstValue
        );

        $this->assertFalse($atLeastTwoEquals);
    }
}
