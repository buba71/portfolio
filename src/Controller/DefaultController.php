<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Class DefaultController
 */
class DefaultController extends AbstractController
{


    /**
     * Hgfdfityd
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('Default/index.html.twig');

    }


}
