<?php

namespace App\tests\Api;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class ApiPostControllerTest extends WebTestCase
{
    public function testPost():void
    {
        $data = array(
            'senderFirstName' => "Da",
            'senderLastName'  => "De Lima",
            'senderMail'      => "d.delima@outlook.fr",
            'messageObj'      => 'none',
            'content'         => 'Voici un message de test !'
        );

        $dataJson = json_encode($data);

        $client = static::createClient();

        $client->request(
            'POST',
            '/api/messages',
            [],
            [],
            ['CONTENT_TYPE' => 'application/ld+json'],
            $dataJson
            );


        echo $client->getResponse()->getContent();

    }
}