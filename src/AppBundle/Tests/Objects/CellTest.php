<?php

namespace Tests\AppBundle\Objects;

use AppBundle\Objects\Cell;
use PHPUnit\Framework\TestCase;

class CellTest extends TestCase
{
    public function testAcceptOnlyOneToNinePosition()
    {
        $randomPosition = rand(1, 9);
        $cell = new Cell();
        $cell->setPosition($randomPosition);

        $this->assertEquals($randomPosition, $cell->getPosition());
    }

    /** @expectedException \RuntimeException
    @expectedExceptionMessage Negative Value aren't accepted
    */
    public function testNotAcceptNegativePosition()
    {
        $cell = new Cell();
        $cell->setPosition(-rand(1, 100));
    }

    /** @expectedException \RuntimeException */
    public function testNotAcceptMoreThanNinePosition()
    {
        $cell = new Cell();
        $cell->setPosition(111);
    }

    public function testAcceptStatus()
    {
        $statusRandom = rand(0,2);
        $cell = new Cell();
        $cell->setStatus($statusRandom);

        $this->assertEquals($statusRandom, $cell->getStatus());
    }

    /** @expectedException \RuntimeException */
    public function testNotAcceptNegativeStatus()
    {
        $cell = new Cell();
        $cell->setStatus(-rand(1, 100));
    }

    /** @expectedException \RuntimeException */
    public function testNotAcceptMoreThanTwoStatus()
    {
        $cell = new Cell();
        $cell->setStatus(rand(3, 100));
    }
}
