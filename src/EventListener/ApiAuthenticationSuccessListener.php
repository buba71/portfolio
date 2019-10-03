<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\Cookie;

class ApiAuthenticationSuccessListener
{
    private $secure = null;

    private $tokenTtl;

    public function __construct($tokenTtl)
    {
        $this->tokenTtl = $tokenTtl;
    }

    /**
     * Set cookie with user admin TOKEN
     * @param AuthenticationSuccessEvent $event
     * @throws \Exception
     */
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        $response = $event->getResponse();
        $data = $event->getData();

        $token = $data['token'];

        $response->headers->setCookie(
            new Cookie(
                'BEARER',
                $token,
                (new \DateTime())
                    ->add(new \DateInterval('PT' . $this->tokenTtl . 'S')),
                '/',
                null,
                $this->secure,
                true,
                false,
                'lax'
            )
        );
        // Add data to the response in case of success
        $data['data'] = array('isLogin' => true);
        $event->setData($data);
    }
}
