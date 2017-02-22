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

        $board = new Board();
        $board->setValue($this->requestMock);

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

        $board = new Board();
        $board->setValue($this->requestMock);

        $this->assertTrue($board->isGameFinished());
    }
}
