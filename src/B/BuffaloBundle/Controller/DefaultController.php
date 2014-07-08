<?php

namespace B\BuffaloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BBuffaloBundle:Default:index.html.twig');
    }
}
