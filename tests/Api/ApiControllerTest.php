<?php

namespace App\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ApiControllerTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    /**
     * @param string $method
     * @param string $uri
     * @param null $content
     * @param array $headers
     * @return Response
     * @ Format the request method (see ApiTestCase)
     */
    protected function request(string $method, string $uri, $content = null, array $headers = []): Response
    {
        $server = ['CONTENT_TYPE' => 'application/ld+json', 'HTTP_ACCEPT' => 'application/ld+json'];
        foreach ($headers as $key => $value) {
            if (strtolower($key) === 'content-type') {
                $server['CONTENT_TYPE'] = $value;

                continue;
            }

            $server['HTTP_'.strtoupper(str_replace('-', '_', $key))] = $value;
        }

        if (is_array($content) && false !== preg_match('#^application/(?:.+\+)?json$#', $server['CONTENT_TYPE'])) {
            $content = json_encode($content);
        }

        $this->client->request($method, $uri, [], [], $server, $content);

        return $this->client->getResponse();
    }

    /**
     * Test Response from api create a new message '/api/messages'.
     */
    public function testCreateMessage():void
    {
        $data = [
            'senderFirstName' => 'David',
            'senderLastName'  => 'De Lima',
            'senderMail'      => 'd.delima@outlook.fr',
            'messageObj'      => 'none',
            'content'         => 'Voici mon premier message issue de mon test fonctionnel'
        ];

        $response = $this->request('POST', '/api/messages', $data);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));
    }

    /**
     * @return void
     * Test Response from get Posts api.
     */
    public function testRetrievePostsList(): void
    {
        $response = $this->request('GET', '/api/posts');

        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));
    }

}
