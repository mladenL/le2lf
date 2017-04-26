<?php

namespace ML\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MLPlatformBundle:Default:index.html.twig');
    }
}
