<?php

namespace Pachanga\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
  public function indexAction($name)
  {
    return $this->render('UsuarioBundle:Default:index.html.twig', array('name' => $name));
  }

  public function loginAction()
  {
    $request = $this->getRequest();
    $session = $request->getSession();
    $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR, $session->get(SecurityContext::AUTHENTICATION_ERROR));

    return $this->render('UsuarioBundle:Default:login.html.twig', array(
      'last_username' => $session->get(SecurityContext::LAST_USERNAME),
      'error'         => $error)
    );
  }

  public function cajaLoginAction($id = '')
  {
    $usuario = $this->get('security.context')->getToken()->getUser();

    $respuesta = $this->render('UsuarioBundle:Default:cajaLogin.html.twig', array(
      'id'      => $id,
      'usuario' => $usuario
    ));

    $respuesta->setMaxAge(30);

    return $respuesta;
  }
}
