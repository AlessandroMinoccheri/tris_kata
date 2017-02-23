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

    /** @expectedException \RuntimeException */
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
}
