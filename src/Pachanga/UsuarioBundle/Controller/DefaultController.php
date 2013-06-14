<?php

namespace Pachanga\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pachanga\UsuarioBundle\Entity\Usuario;
use Pachanga\UsuarioBundle\Form\Frontend\UsuarioRegistroType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;

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

  /**
   *  * @Template("UsuarioBundle:Default:cajaLogin.html.twig")
   *
   */
  public function cajaLoginAction($id = '')
  {
    $usuario = $this->get('security.context')->getToken()->getUser();
    return array('id' => $id, 'usuario' => $usuario );
  }

  public function registroAction()
  {
    $usuario = new Usuario();
    $usuario->setPermiteEmail(true);

    $em = $this->getDoctrine()->getManager();
    $request = $this->getRequest();

    $formulario = $this->createForm(new UsuarioRegistroType(), $usuario);

    if ($request->getMethod() == 'POST') {
      $formulario->bind($request);

      if ($formulario->isValid()) {
        // Completar las propiedades que el usuario no rellena en el formulario
        $usuario->setSalt(md5(time()));

        $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
        $passwordCodificado = $encoder->encodePassword(
          $usuario->getPassword(),
          $usuario->getSalt()
        );
        $usuario->setPassword($passwordCodificado);

        // Guardar el nuevo usuario en la base de datos
        $em->persist($usuario);
        $em->flush();

        // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
        $this->get('session')->setFlash('info',
          '¡Enhorabuena! '.$usuario->getNombre().' te has registrado correctamente en Pachanga'
        );

        return $this->redirect($this->generateUrl('after_registro', array(
          'ciudad' => $usuario->getCiudad()->getSlug()
        )));
      }
    }

    return $this->render('UsuarioBundle:Default:registro.html.twig', array(
      'formulario' => $formulario->createView(),
      'request'    => $request->getmethod()
    ));

  }

  public function afterRegistroAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $ciudad = $this->getRequest()->query->get('ciudad');
    $anuncios = $em->getRepository('AnuncioBundle:Anuncio')->findAnunciosCiudad($ciudad);
    $anuncios = !empty($anuncios) ? $anuncios : null;

    return $this->render('UsuarioBundle:Default:after_registro.html.twig', array(
      'anuncios'    => $anuncios
    ));

  }
}
