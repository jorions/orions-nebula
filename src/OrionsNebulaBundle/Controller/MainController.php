<?php

namespace OrionsNebulaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('OrionsNebulaBundle:Main:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('OrionsNebulaBundle:Main:about.html.twig');
    }
}