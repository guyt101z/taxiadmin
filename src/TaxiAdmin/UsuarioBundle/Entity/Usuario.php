<?php

namespace TaxiAdmin\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TaxiAdmin\UsuarioBundle\Entity\UsuarioRepository")
 */
class Usuario extends Persona implements UserInterface, \Serializable {

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=50)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="rol", type="string", length=50)
     */
    private $rol;

     /**
     * @ORM\Column(type="string", length=32)
     */
     private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=500)
     */
    private $password;
    

    public function __construct() {
        // genero un id único como salt
        $this->salt = md5(uniqid(null, true));
        $this->fechaBaja = null;
        $this->user_roles = new ArrayCollection();
        $this->eventos = new ArrayCollection();
    }

    public function __toString() {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getRoles() {
        return array($this->rol);
    }

    public function getUsername() {
        return $this->email;
    }

    public function eraseCredentials() {
    }

    public function serialize() {
        return serialize(array($this->getId()));
    }

    public function unserialize($serialized) {
        $arr = unserialize($serialized);
        $this->setId($arr[0]);
    }

    public function getSalt() {
        return $this->salt;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }


    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Usuario
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set rol
     *
     * @param string $rol
     * @return Usuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string 
     */
    public function getRol()
    {
        return $this->rol;
    }
}