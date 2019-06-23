<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AdminController
{
    public function index(Environment $twig): Response
    {
        return new Response($twig->render('Default/admin.html.twig'));
    }
}
