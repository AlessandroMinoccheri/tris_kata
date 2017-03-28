<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEnterIntoGame()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/game');

        $response = $client->request(
            'POST',
            '/game', [
                'level' => 'easy',
                'cell_0' => '0',
                'cell_1' => '0',
                'cell_2' => '0',
                'cell_3' => '0',
                'cell_4' => '0',
                'cell_5' => '0',
                'cell_6' => '0',
                'cell_7' => '0',
                'cell_8' => '0',
            ]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEnterNextMove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/game');

        $response = $client->request(
            'POST',
            '/game', [
                'level' => 'difficult',
                'cell_0' => '1',
                'cell_1' => '0',
                'cell_2' => '0',
                'cell_3' => '0',
                'cell_4' => '0',
                'cell_5' => '0',
                'cell_6' => '0',
                'cell_7' => '0',
                'cell_8' => '0',
            ]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
