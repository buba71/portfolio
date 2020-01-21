<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        static::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @return void
     */
    public function testPostsIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/posts');

        static::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
