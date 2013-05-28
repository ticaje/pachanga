<?php

namespace Pachanga\EquipoBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equipo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pachanga\EquipoBundle\Entity\EquipoRepository")
 */
class Equipo
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

    /** @ORM\ManyToOne(targetEntity="Pachanga\EquipoBundle\Entity\Grupo") */
    private $grupo;

    /** @ORM\ManyToOne(targetEntity="Pachanga\CodificadoresBundle\Entity\Deporte") */
    private $deporte;

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
     * @return Equipo
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
     * @return Equipo
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
     * Set deporte
     *
     * @param \Pachanga\CodificadoresBundle\Entity\Deporte $deporte
     * @return Deporte
     */
    public function setDeporte(\Pachanga\CodificadoresBundle\Entity\Deporte $deporte = null)
    {
        $this->deporte = $deporte;

        return $this;
    }

    /**
     * Get deporte
     *
     * @return \Pachanga\CodificadoresBundle\Entity\Deporte
     */
    public function getDeporte()
    {
        return $this->deporte;
    }

    /**
     * Set grupo
     *
     * @param \Pachanga\EquipoBundle\Entity\Grupo $grupo
     * @return Grupo
     */
    public function setGrupo(\Pachanga\EquipoBundle\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \Pachanga\EquipoBundle\Entity\Grupo
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    public function __toString()
    {
      return $this->getNombre();
    }

}
