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

        $this->assertTrue(true, $board->getStatusGame());
    }
}
