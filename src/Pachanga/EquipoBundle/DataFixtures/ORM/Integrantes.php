<?php

/*
 * Este archivo pertenece a la aplicación Pachanga.
 */

namespace Pachanga\EquipoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Pachanga\EquipoBundle\Entity\Integrante;
use Pachanga\UsuarioBundle\Entity\Usuario;

/**
 * Fixtures de la entidad Integrante.
 * Crea para cada equipo 5 integrantes con información muy realista.
 */
class Integrantes extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 6;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las deportes y equipos de la base de datos
        $equipos  = $manager->getRepository('EquipoBundle:Equipo')->findAll();
        $usuarios = $manager->getRepository('UsuarioBundle:Usuario')->findAll();

        foreach ($equipos as $equipo) {
          for ($j=1; $j<=5; $j++) {
            $integrante = new Integrante();
            $integrante->setEquipo($equipo);

            // Seleccionar aleatoriamente una deporte
            $usuario = $usuarios[$j];
            $integrante->setUsuario($usuario);
            $integrante->setFecha(new \DateTime('now - '.rand(1, 150).' days'));

            $manager->persist($integrante);
            $manager->flush();
          }
        }
    }
}
