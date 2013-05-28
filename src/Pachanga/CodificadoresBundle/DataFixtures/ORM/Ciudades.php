<?php

/*
 * Este archivo pertenece a la aplicación de prueba Pachanga.
 */

namespace Pachanga\CodificadoresBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pachanga\CodificadoresBundle\Entity\Ciudad;
use Pachanga\Helpers\Util as Util;

/**
 * Fixtures de la entidad Ciudad.
 * Crea 25 ciudades para poder probar la aplicación.
 */
class Ciudades extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $manager)
    {

        $ciudades = array(
            'Madrid',
            'Barcelona',
            'Valencia',
            'Sevilla',
            'Zaragoza',
            'Málaga',
            'Murcia',
            'Palma de Mallorca',
            'Las Palmas de Gran Canaria',
            'Bilbao',
            'Alicante',
            'Vigo',
            'Gijón',
            'La Coruña',
            'Santa Cruz de Tenerife',
        );

        foreach ($ciudades as $nombre) {
            $ciudad = new Ciudad();
            $ciudad->setNombre($nombre);
            $slugNombre = Util::slugify($nombre);
            $ciudad->setSlug($slugNombre);

            $manager->persist($ciudad);
        }

        $manager->flush();
    }
}
