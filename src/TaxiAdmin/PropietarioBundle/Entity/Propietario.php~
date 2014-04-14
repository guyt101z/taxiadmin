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
     * @ORM\ManyToMany(targetEntity="TaxiAdmin\EmpresaBundle\Entity\Empresa", mappedBy="propietarios")
     */
     private $empresas;


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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empresas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add empresas
     *
     * @param \TaxiAdmin\EmpresaBundle\Entity\Empresa $empresas
     * @return Propietario
     */
    public function addEmpresa(\TaxiAdmin\EmpresaBundle\Entity\Empresa $empresas)
    {
        $this->empresas[] = $empresas;
    
        return $this;
    }

    /**
     * Remove empresas
     *
     * @param \TaxiAdmin\EmpresaBundle\Entity\Empresa $empresas
     */
    public function removeEmpresa(\TaxiAdmin\EmpresaBundle\Entity\Empresa $empresas)
    {
        $this->empresas->removeElement($empresas);
    }

    /**
     * Get empresas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpresas()
    {
        return $this->empresas;
    }
}