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

        $this->requestMock = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->request = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testCreateCpuWithBoardEasy()
    {
        $board = new Board($this->checkerMock);
        $cpu = new Cpu();
        $cpu->setLevel('easy');
        $cpu->setBoard($board);
        $cpu->moveCpu();
    }

    public function testCreateCpuWithBoardDifficult()
    {
        $board = new Board($this->checkerMock);
        $cpu = new Cpu();
        $cpu->setLevel('difficult');
        $cpu->setBoard($board);
        $cpu->moveCpu();
    }

    public function testCreateCpuWithBoardDifficultWithPartialTrisDefense()
    {
        $this->requestMock->request->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(1))
            ->method('get')
            ->will($this->returnValue('1'));

        $board = new Board($this->checkerMock);
        $board->setValueFromRequest($this->requestMock);

        $cpu = new Cpu();
        $cpu->setLevel('difficult');
        $cpu->setBoard($board);
        $position = $cpu->moveCpu();

        $this->assertEquals(2, $position);
    }

    public function testCreateCpuWithBoardDifficultWithPartialTrisOffense()
    {
        $this->requestMock->request->expects($this->at(3))
            ->method('get')
            ->will($this->returnValue('2'));

        $this->requestMock->request->expects($this->at(4))
            ->method('get')
            ->will($this->returnValue('2'));

        $board = new Board($this->checkerMock);
        $board->setValueFromRequest($this->requestMock);

        $cpu = new Cpu();
        $cpu->setLevel('difficult');
        $cpu->setBoard($board);
        $position = $cpu->moveCpu();

        $this->assertEquals(5, $position);
    }
}
