<?php

namespace Pachanga\EquipoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Integrantes
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Integrantes
{
  /** @ORM\Column(type="datetime") */
  private $fecha;

  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Pachanga\EquipoBundle\Entity\Equipo")
  */
  private $equipo;

  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Pachanga\UsuarioBundle\Entity\Usuario")
  */
  private $usuario;

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
  }

  public function getFecha()
  {
    return $this->fecha;
  }

  public function setEquipo(\Pachanga\EquipoBundle\Entity\Equipo $equipo)
  {
    $this->equipo = $equipo;
  }

  public function getEquipo()
  {
    return $this->equipo;
  }

  public function setUsuario(\Pachanga\UsuarioBundle\Entity\Usuario $usuario)
  {
    $this->usuario = $usuario;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }
}
