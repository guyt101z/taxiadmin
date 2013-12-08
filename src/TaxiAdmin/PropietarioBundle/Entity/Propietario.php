<?php

namespace TaxiAdmin\PropietarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TaxiAdmin\UsuarioBundle\Entity\Persona;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Propietario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TaxiAdmin\PropietarioBundle\Entity\PropietarioRepository")
 */
class Propietario extends Persona {

    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     * @Assert\Email( message = "El Email '{{ value }}' ingresado no tiene el formato correcto." )
     */
    private $email;


    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return Propietario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Propietario
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
}