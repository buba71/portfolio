<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiNotAutorizedListener
{
    /**
     * Custom the response Failure message
     * @param JWTNotFoundEvent $event
     */
    public function onNotAuthorizedApiEndPoint(JWTNotFoundEvent $event)
    {
        $data = [
            'status'   => '401 Unauthorized',
            'message'  => 'Vous n\'êtes pas authorisé à accéder à cette ressource.',
            'isLogin' => false
        ];

        $response = new JsonResponse($data);
        $event->setResponse($response);
    }
}
