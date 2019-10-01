<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testIndex(): void
    {
        $client =static::createClient();
        $client->request('GET', '/admin');

        static::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
