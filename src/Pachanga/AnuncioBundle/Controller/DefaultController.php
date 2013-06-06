<?php

namespace Pachanga\AnuncioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pachanga\Helpers\Util as Util;

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
        $ciudad = Util::slugify($ciudad);
        $em = $this->getDoctrine()->getManager();
        $anuncios = $em->getRepository('AnuncioBundle:Anuncio')->findAnunciosCiudad($ciudad);

        if (!$anuncios) {
            $exception = $this->createNotFoundException('No se ha encontrado ninguna anuncio del día en la ciudad seleccionada');
            $respuesta = $this->render('AnuncioBundle:Exception:error404.html.twig', array('exception' => $exception));
        }
        else{
          $respuesta = $this->render('AnuncioBundle:Default:portada.html.twig', array(
            'anuncios' => $anuncios
          ));
        }
        $respuesta->setSharedMaxAge(60);

        return $respuesta;
    }

    public function anunciosAction(Request $request)
    {
        $ciudad = Util::slugify($request->get('ciudad'));
        return $this->portadaAction($ciudad);
    }
}
