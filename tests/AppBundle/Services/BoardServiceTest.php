<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Services\Board;

class BoardServiceTest extends WebTestCase
{
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

        $board = new Board();
        $board->setValue($this->requestMock);

        $this->assertFalse($board->getIfIsFinishGame());
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

        //set first 3 cells
        //6 because every cells call two times get request
        for($i = 0; $i < 6; $i++){
            $this->requestMock->request->expects($this->at($i))
                ->method('get')
                ->will($this->returnValue('1'));
        }

        $board = new Board();
        $board->setValue($this->requestMock);

        $this->assertTrue($board->getIfIsFinishGame());
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

        //set first 3 cells
        //6 because every cells call two times get request
        for($i = 0; $i < 6; $i++){
            $this->requestMock->request->expects($this->at($i))
                ->method('get')
                ->will($this->returnValue('1'));
        }

        $this->requestMock->request->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(1))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(6))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(7))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(12))
            ->method('get')
            ->will($this->returnValue('1'));

        $this->requestMock->request->expects($this->at(13))
            ->method('get')
            ->will($this->returnValue('1'));

        $board = new Board();
        $board->setValue($this->requestMock);

        $this->assertTrue($board->getIfIsFinishGame());
    }
}
