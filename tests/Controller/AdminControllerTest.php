<?php

namespace App\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AdminControllerTest extends WebTestCase
{
    public function testAdminLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');



        $form = $crawler->selectButton('Sign in')->form();

        $form['email'] = 'd.delima@outlook.fr';
        $form['password'] = 'yqpkaqrv';

        $crawler = $client->submit($form);



        echo ($client->getResponse()->getContent());


    }
}