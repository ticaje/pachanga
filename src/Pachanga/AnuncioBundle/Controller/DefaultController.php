<?php

namespace Pachanga\AnuncioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AnuncioBundle:Default:index.html.twig', array('name' => $name));
    }
}
