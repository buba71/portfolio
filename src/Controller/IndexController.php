<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class DefaultController
 */
final class IndexController
{
    /**
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(Environment $twig): Response
    {
        return new Response($twig->render('Home/index.html.twig'));
    }
}
