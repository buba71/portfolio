<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


/**
 * Class DefaultController
 */
class DefaultController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Environment $twig): Response
    {
        return new Response($twig->render('Default/index.html.twig'));
    }
}
