<?php

/*
 * Este archivo pertenece a la aplicación de prueba Pachanga.
 * El código fuente de la aplicación incluye un archivo llamado LICENSE
 * con toda la información sobre el copyright y la licencia.
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
        return 10;
    }

    public function load(ObjectManager $manager)
    {
        // Los 25 municipios más poblados de España según el INE
        // fuente: http://es.wikipedia.org/wiki/Municipios_de_Espa%C3%B1a_por_poblaci%C3%B3n

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
            'Córdoba',
            'Valladolid',
            'Vigo',
            'Gijón',
            'Hospitalet de Llobregat',
            'La Coruña',
            'Granada',
            'Vitoria-Gasteiz',
            'Elche',
            'Oviedo',
            'Santa Cruz de Tenerife',
            'Badalona',
            'Cartagena',
            'Tarrasa',
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