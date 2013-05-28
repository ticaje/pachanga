<?php

namespace Pachanga\AnuncioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Respuesta
{
  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Pachanga\AnuncioBundle\Entity\Anuncio")
   */
  private $anuncio;

  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Pachanga\UsuarioBundle\Entity\Usuario")
   */
  private $usuario;
  /**
   * @var string
   *
   * @ORM\Column(name="texto", type="text")
   */
  private $texto;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="fecha", type="datetime")
   */
  private $fecha;

  /**
   * Set usuario
   *
   * @param \Pachanga\UsuarioBundle\Entity\Usuario $usuario
   * @return Usuario
   */
  public function setUsuario(\Pachanga\UsuarioBundle\Entity\Usuario $usuario)
  {
    $this->usuario = $usuario;
  }

  /**
   * Get usuario
   *
   * @return \Pachanga\UsuarioBundle\Entity\Usuario
   */
  public function getUsuario()
  {
    return $this->usuario;
  }

  /**
   * Set anuncio
   *
   * @return \Pachanga\AnuncioBundle\Entity\Anuncio $anuncio
   */
  public function setAnuncio(\Pachanga\AnuncioBundle\Entity\Anuncio $anuncio)
  {
    $this->anuncio = $anuncio;
  }

  /**
   * Get anuncio
   *
   * @return \Pachanga\AnuncioBundle\Entity\Anuncio
   */
  public function getAnuncio()
  {
    return $this->anuncio;
  }

  /**
   * Set texto
   *
   * @param string $texto
   * @return Respuesta
   */
  public function setTexto($texto)
  {
    $this->texto = $texto;

    return $this;
  }

  /**
   * Get texto
   *
   * @return string
   */
  public function getTexto()
  {
    return $this->texto;
  }

  /**
   * Set fecha
   *
   * @param \DateTime $fecha
   * @return Respuesta
   */
  public function setFecha($fecha)
  {
    $this->fecha = $fecha;

    return $this;
  }

  /**
   * Get fecha
   *
   * @return \DateTime
   */
  public function getFecha()
  {
    return $this->fecha;
  }
}
