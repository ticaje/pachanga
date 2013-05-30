<?php

namespace Pachanga\AnuncioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AnuncioBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * Muestra la portada del sitio web
     *
     * @param string $ciudad El slug de la ciudad activa en la aplicación
     */
    public function portadaAction($ciudad)
    {
        $em = $this->getDoctrine()->getManager();
        $anuncios = $em->getRepository('AnuncioBundle:Anuncio')->findBy(array('actividad' => 2));

        if (!$anuncios) {
            throw $this->createNotFoundException('No se ha encontrado ninguna anuncio del día en la ciudad seleccionada');
        }

        $respuesta = $this->render('AnuncioBundle:Default:portada.html.twig', array(
            'anuncios' => $anuncios
        ));
        $respuesta->setSharedMaxAge(60);

        return $respuesta;
    }
}
