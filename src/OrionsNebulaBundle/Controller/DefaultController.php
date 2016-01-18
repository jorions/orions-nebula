<?php

namespace OrionsNebulaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OrionsNebulaBundle:Default:index.html.twig');
    }
}
