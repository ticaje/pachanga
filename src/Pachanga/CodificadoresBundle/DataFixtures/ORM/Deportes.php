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
use Pachanga\CodificadoresBundle\Entity\Deporte;
use Pachanga\Helpers\Util as Util;

/**
 * Fixtures de la entidad Deporte.
 * Crea 25 deportes para poder probar la aplicación.
 */
class Deportes extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 10;
    }

    public function load(ObjectManager $manager)
    {
        // Los 25 municipios más poblados de España según el INE
        // fuente: http://es.wikipedia.org/wiki/Municipios_de_Espa%C3%B1a_por_poblaci%C3%B3n

        $deportes = array(
            array ('Balonmano', 6),
            array ('Baloncesto', 5),
            array ('Futbol 7', 7),
            array ('Futbol 11', 11),
            array ('Futbol Sala', 5),
        );

        foreach ($deportes as $depor) {
            $deporte = new Deporte();
            $nombre = $depor[0];
            $num_jugadores = $depor[1];
            $deporte->setNombre($nombre);
            $slugNombre = Util::slugify($nombre);
            $deporte->setSlug($slugNombre);
            $deporte->setNumeroJugadores($num_jugadores);

            $manager->persist($deporte);
        }

        $manager->flush();
    }
}
