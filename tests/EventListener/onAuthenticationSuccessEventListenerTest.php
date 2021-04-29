<?php

namespace App\Tests\Api\EventListener;

use App\Entity\User;
use App\EventListener\ApiAuthenticationSuccessListener;
use Symfony\Component\HttpFoundation\Response;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use PHPUnit\Framework\TestCase;

class OnAuthenticationSuccessEventListenerTest extends TestCase
{
    private $response;
    private $user;

    public function setUp(): void
    {
        $this->response = new Response;
        $this->user = new User();
    }

    public function testResponseOnApiAuthenticationSuccess(): void
    {
        $token = bin2hex(random_bytes(16));
        $data = [
            'token' => $token
        ];


        $event = new AuthenticationSuccessEvent($data, $this->user, $this->response);

        $apiAuthenticationSuccessEvent = new ApiAuthenticationSuccessListener(3600);
        $apiAuthenticationSuccessEvent->onAuthenticationSuccess($event);

        static::assertCount(1, $event->getResponse()->headers->getCookies());  // Has BEARER cookie.
        static::assertContains($token, $event->getData());                                   //  Response contain the token.
        static::assertEquals(true, $event->getData()['data']['isLogin']);          // isLogin status is "true".
        static::assertEquals(200, $event->getResponse()->getStatusCode());         // Response status code = 200.
    }
}
