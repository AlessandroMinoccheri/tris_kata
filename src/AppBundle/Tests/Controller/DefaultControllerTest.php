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

    public function testNotSetLevel()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/game');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
