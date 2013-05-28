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
use Pachanga\CodificadoresBundle\Entity;
use Pachanga\EquipoBundle\Entity\Equipo;
use Pachanga\EquipoBundle\Entity\Grupo;
use Pachanga\Helpers\Util as Util;

/**
 * Fixtures de la entidad Equipo.
 * Crea para cada grupo 5 equipos con información muy realista.
 */
class Equipos extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 4;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las deportes y grupos de la base de datos
        $grupos   = $manager->getRepository('EquipoBundle:Grupo')->findAll();
        $deportes = $manager->getRepository('CodificadoresBundle:Deporte')->findAll();

        foreach ($grupos as $grupo) {

            for ($j=1; $j<=5; $j++) {
                $equipo = new Equipo();

                $nombre = $this->getNombre();
                $equipo->setNombre($nombre);
                $equipo->setSlug(Util::slugify($nombre));
                $equipo->setGrupo($grupo);

                // Seleccionar aleatoriamente una deporte
                $deporte = $deportes[array_rand($deportes)];
                $equipo->setDeporte($deporte);

                $manager->persist($equipo);

            }
        }
        $manager->flush();
    }

    /**
     * Generador aleatorio de nombres de equipos.
     *
     * @return string Nombre/título aletorio generado para el equipo.
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
     * Generador aleatorio de descripciones de equipos.
     *
     * @return string Descripción aletoria generada para el equipo.
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
