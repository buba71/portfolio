<?php

namespace App\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'd.delima@outlook.fr',
            'PHP_AUTH_PW'   => 'yqpkaqrv',
        ]);
    }
}
