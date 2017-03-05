<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Services\Board;
use AppBundle\Services\Cpu;

class CpuServiceTest extends WebTestCase
{
    public function testCreateCpuWithBoard()
    {
        $board = new Board();
        Cpu::createCpuWithBoard($board);
    }
}
