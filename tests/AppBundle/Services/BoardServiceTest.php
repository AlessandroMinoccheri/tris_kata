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

        $this->assertTrue($board->getIfIsFinishGame());
    }

    public function testGetSatusGameEnd()
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
}
