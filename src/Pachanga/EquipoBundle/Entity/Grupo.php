<?php

namespace Pachanga\EquipoBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Grupo implements UserInterface
{
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
    return array('ROLE_GRUPO');
  }

  /**
   * Método requerido por la interfaz UserInterface
   */
  public function getUsername()
  {
    return $this->getLogin();
  }

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
   * @var string $email
   *
   * @ORM\Column(name="email", type="string", length=255, unique=true)
   * @Assert\Email()
   */
  private $email;

  /**
   * @var string
   *
   * @ORM\Column(name="login", type="string", length=255)
   */
  private $login;

  /**
   * @var string $password
   *
   * @ORM\Column(name="password", type="string", length=255)
   * @Assert\NotBlank()
   * @Assert\Length(min = 6)
   */
  private $password;

  /**
   * @var string
   *
   * @ORM\Column(name="salt", type="string", length=255)
   */
  private $salt;

  /** @ORM\ManyToOne(targetEntity="Pachanga\CodificadoresBundle\Entity\Ciudad") */
  private $ciudad;


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
   * @return Grupo
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
   * @return Grupo
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
   * Set email
   *
   * @param string $email
   * @return Grupo
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
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
   * Set login
   *
   * @param string $login
   * @return Grupo
   */
  public function setLogin($login)
  {
    $this->login = $login;

    return $this;
  }

  /**
   * Get login
   *
   * @return string
   */
  public function getLogin()
  {
    return $this->login;
  }

  /**
   * Set password
   *
   * @param string $password
   * @return Grupo
   */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
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
   * @return Grupo
   */
  public function setSalt($salt)
  {
    $this->salt = $salt;

    return $this;
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
   * Set ciudad
   *
   * @param \Pachanga\CodificadoresBundle\Entity\Ciudad $ciudad
   * @return Ciudad
   */
  public function setCiudad(\Pachanga\CodificadoresBundle\Entity\Ciudad $ciudad = null)
  {
    $this->ciudad = $ciudad;

    return $this;
  }

  /**
   * Get ciudad
   *
   * @return \Pachanga\CodificadoresBundle\Entity\Ciudad
   */
  public function getCiudad()
  {
    return $this->ciudad;
  }

  public function __toString()
  {
    return $this->getNombre();
  }

}
