<?php

/*
 * Este archivo pertenece a la aplicación Pachanga.
 */

namespace Pachanga\UsuarioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Pachanga\CodificadoresBundle\Entity\Ciudad;
use Pachanga\UsuarioBundle\Entity\Usuario;
use Pachanga\Helpers\Util as Util;

/**
 * Fixtures de la entidad Usuario.
 * Crea 300 usuarios de prueba con información muy realista.
 */
class Usuarios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 5;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ciudades de la base de datos
        $ciudades = $manager->getRepository('CodificadoresBundle:Ciudad')->findAll();

        for ($i=1; $i<=300; $i++) {
            $usuario = new Usuario();

            $nombre = Util::getNombre();
            $nombre_slugified = Util::getUsername($nombre);
            $usuario->setNombre($nombre);
            $usuario->setEmail($nombre_slugified.$i.'@localhost');

            $usuario->setSalt('');//(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));

            $passwordEnClaro = $nombre_slugified;
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($usuario);
            $passwordCodificado = $encoder->encodePassword($passwordEnClaro, $usuario->getSalt());
            $usuario->setPassword($passwordEnClaro);

            $ciudad = $ciudades[array_rand($ciudades)];
            $usuario->setCiudad($ciudad);

            // El 60% de los usuarios permite email
            $usuario->setPermiteEmail((rand(1, 1000) % 10) < 6);

            $usuario->setFechaAlta(new \DateTime('now - '.rand(1, 150).' days'));

            $manager->persist($usuario);
        }

        $manager->flush();
    }

}
