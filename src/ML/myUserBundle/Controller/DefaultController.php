<?php

namespace ML\myUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MLmyUserBundle:Default:index.html.twig');
    }
}
