<?php

namespace TaxiAdmin\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TaxiAdmin\UsuarioBundle\Entity\UsuarioRepository")
 * @UniqueEntity("email")
 */
class Usuario extends Persona implements UserInterface, \Serializable {

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
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\Email( message = "El Email '{{ value }}' ingresado no tiene el formato correcto." )
     * @Assert\NotNull(message="Debe ingresar un Email")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=500)
     */
    private $password;
    

    public function __construct() {
        // genero un id único como salt
        $this->salt = md5(uniqid(null, true));
        // creo los arrays para guardar la info
        $this->user_roles = new ArrayCollection();
    }

    public function __toString() {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getRoles() {
        return array($this->rol);
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->email;
    }

    public function eraseCredentials() {
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

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
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
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }
}