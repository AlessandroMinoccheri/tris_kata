<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Services\Board;
use AppBundle\Services\Cpu;

class CpuServiceTest extends WebTestCase
{
    public function setUp()
    {
        $this->checkerMock = $this
            ->getMockBuilder('AppBundle\Services\Checker')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testCreateCpuWithBoard()
    {
        $board = new Board($this->checkerMock);
        $cpu = new Cpu();
        $cpu->setLevel('easy');
        $cpu->setBoard($board);
        $cpu->moveCpu();
    }
}
