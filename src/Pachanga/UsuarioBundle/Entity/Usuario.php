<?php

namespace Pachanga\UsuarioBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\ExecutionContext;

/**
 * Pachanga\UsuarioBundle\Entity\Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pachanga\UsuarioBundle\Entity\UsuarioRepository")
 * @DoctrineAssert\UniqueEntity("email")
 */
class Usuario implements UserInterface
{

  public function __sleep()
  {
    return array('id');
  }
  /**
   * Método requerido por la interfaz UserInterface
   */
  public function eraseCredentials()
  {
  }

  /**
   * Método requerido por la interfaz UserInterface
   */
  public function getRoles()
  {
    return array('ROLE_USUARIO');
  }

  /**
   * Método requerido por la interfaz UserInterface
   */
  public function getUsername()
  {
    return $this->getEmail();
  }

  /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string $nombre
   *
   * @ORM\Column(name="nombre", type="string", length=100)
   * @Assert\NotBlank()
   */
  private $nombre;

  /**
   * @var string $email
   *
   * @ORM\Column(name="email", type="string", length=255, unique=true)
   * @Assert\Email()
   */
  private $email;

  /**
   * @var string $password
   *
   * @ORM\Column(name="password", type="string", length=255)
   * @Assert\NotBlank(groups={"registro"})
   * @Assert\Length(min = 6)
   */
  private $password;

  /**
   * @var string salt
   *
   * @ORM\Column(name="salt", type="string", length=255)
   */
  protected $salt;

  /**
   * @var boolean $permite_email
   *
   * @ORM\Column(name="permite_email", type="boolean")
   * @Assert\Type(type="bool")
   */
  private $permite_email;

  /**
   * @var datetime $fecha_alta
   *
   * @ORM\Column(name="fecha_alta", type="datetime")
   * @Assert\DateTime()
   */
  private $fecha_alta;

  /**
   * @var integer $ciudad
   *
   * @ORM\ManyToOne(targetEntity="Pachanga\CodificadoresBundle\Entity\Ciudad", inversedBy="usuarios")
   * @Assert\Type("Pachanga\CiudadBundle\Entity\Ciudad")
   */
  private $ciudad;

  public function __construct()
  {
    $this->fecha_alta = new \DateTime();
  }

  public function __toString()
  {
    return $this->getNombre();
  }

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
   */
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
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
   * Set email
   *
   * @param string $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }

  /**
   * Get email
   *
   * @return string
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set password
   *
   * @param string $password
   */
  public function setPassword($password)
  {
    $this->password = $password;
  }

  /**
   * Get password
   *
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set salt
   *
   * @param string $salt
   */
  public function setSalt($salt)
  {
    $this->salt = $salt;
  }

  /**
   * Get salt
   *
   * @return string
   */
  public function getSalt()
  {
    return $this->salt;
  }

  /**
   * Set permite_email
   *
   * @param boolean $permiteEmail
   */
  public function setPermiteEmail($permiteEmail)
  {
    $this->permite_email = $permiteEmail;
  }

  /**
   * Get permite_email
   *
   * @return boolean
   */
  public function getPermiteEmail()
  {
    return $this->permite_email;
  }

  /**
   * Set fecha_alta
   *
   * @param datetime $fechaAlta
   */
  public function setFechaAlta($fechaAlta)
  {
    $this->fecha_alta = $fechaAlta;
  }

  /**
   * Get fecha_alta
   *
   * @return datetime
   */
  public function getFechaAlta()
  {
    return $this->fecha_alta;
  }

  /**
   * Set ciudad
   *
   * @param Pachanga\CiudadBundle\Entity\Ciudad $ciudad
   */
  public function setCiudad(\Pachanga\CodificadoresBundle\Entity\Ciudad $ciudad)
  {
    $this->ciudad = $ciudad;
  }

  /**
   * Get ciudad
   *
   * @return Pachanga\CodificadoresBundle\Entity\Ciudad
   */
  public function getCiudad()
  {
    return $this->ciudad;
  }
}
