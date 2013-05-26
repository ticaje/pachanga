<?php

namespace Pachanga\CodificadoresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deporte
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pachanga\CodificadoresBundle\Entity\DeporteRepository")
 */
class Deporte
{
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="nombre", type="string", length=255)
   */
  private $nombre;

  /**
   * @var string
   *
   * @ORM\Column(name="slug", type="string", length=255)
   */
  private $slug;

  /**
   * @var integer
   *
   * @ORM\Column(name="numero_jugadores", type="integer")
   */
  private $numeroJugadores;


  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set nombre
   *
   * @param string $nombre
   * @return Deporte
   */
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;

    return $this;
  }

  /**
   * Get nombre
   *
   * @return string
   */
  public function getNombre()
  {
    return $this->nombre;
  }

  /**
   * Set slug
   *
   * @param string $slug
   * @return Deporte
   */
  public function setSlug($slug)
  {
    $this->slug = $slug;

    return $this;
  }

  /**
   * Get slug
   *
   * @return string
   */
  public function getSlug()
  {
    return $this->slug;
  }

  /**
   * Set numeroJugadores
   *
   * @param integer $numeroJugadores
   * @return Deporte
   */
  public function setNumeroJugadores($numeroJugadores)
  {
    $this->numeroJugadores = $numeroJugadores;

    return $this;
  }

  /**
   * Get numeroJugadores
   *
   * @return integer
   */
  public function getNumeroJugadores()
  {
    return $this->numeroJugadores;
  }

  public function __toString()
  {
    return $this->getNombre();
  }
}
