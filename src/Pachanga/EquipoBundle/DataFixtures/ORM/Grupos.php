<?php

/*
 * Este archivo pertenece a la aplicación Pachanga.
 */

namespace Pachanga\GrupoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Pachanga\CodificadoresBundle\Entity;
use Pachanga\EquipoBundle\Entity\Grupo;
use Pachanga\Helpers\Util as Util;

/**
 * Fixtures de la entidad Grupo.
 * Crea para cada ciudad 5 grupos con información muy realista.
 */
class Grupos extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 3;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las deportes y ciudades de la base de datos
        $ciudades = $manager->getRepository('CodificadoresBundle:Ciudad')->findAll();

        $i = 1;
        foreach ($ciudades as $ciudad) {

            for ($j=1; $j<=5; $j++) {
                $grupo = new Grupo();

                $nombre = $this->getNombre();
                $grupo->setNombre($nombre);
                $grupo->setSlug(Util::slugify($nombre));
                $grupo->setLogin('grupo'.$j.$i);
                $grupo->setEmail('grupo'.$j.$i.'@localhost');

                $grupo->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));

                $passwordPlano = 'grupo'.$j;
                $encoder = $this->container->get('security.encoder_factory')->getEncoder($grupo);
                $passwordCodificado = $encoder->encodePassword($passwordPlano, $grupo->getSalt());
                $grupo->setPassword($passwordCodificado);

                $grupo->setCiudad($ciudad);

                $manager->persist($grupo);
            }
            $i = $i + 1;
        }
        $manager->flush();
    }

    /**
     * Generador aleatorio de nombres de grupos.
     *
     * @return string Nombre/título aletorio generado para el grupo.
     */
    private function getNombre()
    {
        $palabras = array_flip(array(
            'Lorem', 'Ipsum', 'Sitamet', 'Et', 'At', 'Sed', 'Aut', 'Vel', 'Ut',
            'Dum', 'Tincidunt', 'Facilisis', 'Nulla', 'Scelerisque', 'Blandit',
            'Ligula', 'Eget', 'Drerit', 'Malesuada', 'Enimsit', 'Libero',
            'Penatibus', 'Imperdiet', 'Pendisse', 'Vulputae', 'Natoque',
            'Aliquam', 'Dapibus', 'Lacinia'
        ));

        $numeroPalabras = rand(4, 8);

        return implode(' ', array_rand($palabras, $numeroPalabras));
    }

    /**
     * Generador aleatorio de descripciones de grupos.
     *
     * @return string Descripción aletoria generada para el grupo.
     */
    private function getDescripcion()
    {
        $frases = array_flip(array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'Mauris ultricies nunc nec sapien tincidunt facilisis.',
            'Nulla scelerisque blandit ligula eget hendrerit.',
            'Sed malesuada, enim sit amet ultricies semper, elit leo lacinia massa, in tempus nisl ipsum quis libero.',
            'Aliquam molestie neque non augue molestie bibendum.',
            'Pellentesque ultricies erat ac lorem pharetra vulputate.',
            'Donec dapibus blandit odio, in auctor turpis commodo ut.',
            'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'Nam rhoncus lorem sed libero hendrerit accumsan.',
            'Maecenas non erat eu justo rutrum condimentum.',
            'Suspendisse leo tortor, tempus in lacinia sit amet, varius eu urna.',
            'Phasellus eu leo tellus, et accumsan libero.',
            'Pellentesque fringilla ipsum nec justo tempus elementum.',
            'Aliquam dapibus metus aliquam ante lacinia blandit.',
            'Donec ornare lacus vitae dolor imperdiet vitae ultricies nibh congue.',
        ));

        $numeroFrases = rand(4, 7);

        return implode("\n", array_rand($frases, $numeroFrases));
    }

}
