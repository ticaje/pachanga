<?php

/*
 * Este archivo pertenece a la aplicación Pachanga.
 */

namespace Pachanga\AnuncioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Pachanga\AnuncioBundle\Entity\Anuncio;
use Pachanga\AnuncioBundle\Entity\Respuesta;
use Pachanga\UsuarioBundle\Entity\Usuario;
use Pachanga\Helpers\Util as Util;

/**
 * Fixtures de la entidad Integrante.
 * Crea para 20 anuncios 5 respuestas con información muy realista.
 */
class Respuestas extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 9;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las deportes y anuncios de la base de datos
        $anuncios = $manager->createQuery('Select a FROM AnuncioBundle:Anuncio a')
          ->setMaxResults(20)
          ->getResult();
        $usuarios = $manager->createQuery('Select u FROM UsuarioBundle:Usuario u')
          ->setMaxResults(20)
          ->getResult();

        foreach ($anuncios as $anuncio) {
          for ($j=1; $j<=5; $j++) {
            $respuesta = new Respuesta();
            $respuesta->setAnuncio($anuncio);

            // Seleccionar aleatoriamente una deporte
            $usuario = $usuarios[$j];
            $respuesta->setUsuario($usuario);
            $respuesta->setTexto(Util::getFrase());

            $respuesta->setFecha(new \DateTime('now - '.rand(1, 150).' days'));

            $manager->persist($respuesta);
            $manager->flush();
          }
        }
    }
}
