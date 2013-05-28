<?php

/*
 * Este archivo pertenece a la aplicación Pachanga.
 */

namespace Pachanga\ActividadBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Pachanga\CodificadoresBundle\Entity;
use Pachanga\EquipoBundle\Entity\Actividad;
use Pachanga\EquipoBundle\Entity\Equipo;
use Pachanga\Helpers\Util as Util;

/**
 * Fixtures de la entidad Actividad.
 * Crea para 100 equipos 5 actividades con información muy realista.
 */
class Actividades extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 7;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las deportes y grupos de la base de datos
        $equipos = $manager->createQuery('Select e FROM EquipoBundle:Equipo e')
          ->setMaxResults(100)
          ->getResult();

        foreach ($equipos as $equipo) {

            for ($j=1; $j<=5; $j++) {
                $actividad = new Actividad();

                $nombre = $this->getNombre();
                $actividad->setNombre($nombre);
                $actividad->setSlug(Util::slugify($nombre));
                $actividad->setFecha(new \DateTime('now - '.rand(1, 150).' days'));
                $actividad->setEquipo($equipo);

                $manager->persist($actividad);

            }
        }
        $manager->flush();
    }

    /**
     * Generador aleatorio de nombres de actividades.
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
     * Generador aleatorio de descripciones de actividades.
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
