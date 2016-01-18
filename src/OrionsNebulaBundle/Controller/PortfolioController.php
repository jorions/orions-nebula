<?php

namespace OrionsNebulaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortfolioController extends Controller
{
    public function portfolioMainAction()
    {
        return $this->render('OrionsNebulaBundle:Portfolio:portfolioMain.html.twig');
    }

    public function artworkAction()
    {
        return $this->render('OrionsNebulaBundle:Portfolio:artwork.html.twig');
    }
    
    public function programmingAction()
    {
        return $this->render('OrionsNebulaBundle:Portfolio:programming.html.twig');
    }
}