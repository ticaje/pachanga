<?php

namespace Pachanga\CodificadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CodificadoresBundle:Default:index.html.twig', array('name' => $name));
    }
}
