<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Services\Board;

class BoardServiceTest extends WebTestCase
{
    public function setUp()
    {
        $this->checkerMock = $this
            ->getMockBuilder('AppBundle\Services\Checker')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetSatusGameNotEnd()
    {
        $this->requestMock = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->request = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkerMock->expects($this->any())
            ->method('checkIfCellEquals')
            ->will($this->returnValue(false));

        $board = new Board($this->checkerMock);
        $board->setValueFromRequest($this->requestMock);

        $this->assertFalse($board->isGameFinished());
    }

    public function testGetSatusGameEndHorizontal()
    {
        $this->requestMock = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->request = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();

        for($i = 0; $i < 3; $i++){
            $this->requestMock->request->expects($this->at($i))
                ->method('get')
                ->will($this->returnValue('1'));
        }

        $this->checkerMock->expects($this->any())
            ->method('checkIfCellEquals')
            ->will($this->returnValue(true));

        $board = new Board($this->checkerMock);
        $board->setValueFromRequest($this->requestMock);

        $this->assertTrue($board->isGameFinished());
    }

    public function testGetSatusGameEndVertical()
    {
        $this->requestMock = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->request = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->request->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(3))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(6))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->checkerMock->expects($this->any())
            ->method('checkIfCellEquals')
            ->will($this->returnValue(true));

        $board = new Board($this->checkerMock);
        $board->setValueFromRequest($this->requestMock);

        $this->assertTrue($board->isGameFinished());
    }

    public function testGetSatusGameEndOblique()
    {
        $this->requestMock = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->request = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\ParameterBag')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->request->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(4))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(8))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->checkerMock->expects($this->any())
            ->method('checkIfCellEquals')
            ->will($this->returnValue(true));

        $board = new Board($this->checkerMock);
        $board->setValueFromRequest($this->requestMock);

        $this->assertTrue($board->isGameFinished());
    }
}
