<?php

namespace TaxiAdmin\ChoferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use TaxiAdmin\UsuarioBundle\Entity\Persona;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Chofer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TaxiAdmin\ChoferBundle\Entity\ChoferRepository")
 */
class Chofer extends Persona {

    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer")
     */
    private $idUsuario;

    /**
     * @var float
     *
     * @ORM\Column(name="aporteLeyes", type="float")
     */
    private $aporteLeyes;

    /**
     * @var float
     *
     * @ORM\Column(name="porcentajeLiquidacion", type="float")
     */
    private $porcentajeLiquidacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencCarneSalud", type="datetime")
     */
    private $vencCarneSalud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencLibretaConducir", type="datetime")
     */
    private $vencLibretaConducir;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     * @Assert\Email( message = "El Email '{{ value }}' ingresado no tiene el formato correcto." )
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="TaxiAdmin\EmpresaBundle\Entity\Empresa", mappedBy="choferes")
     */
     private $empresas;


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
     * Set aporteLeyes
     *
     * @param float $aporteLeyes
     * @return Chofer
     */
    public function setAporteLeyes($aporteLeyes)
    {
        $this->aporteLeyes = $aporteLeyes;
    
        return $this;
    }

    /**
     * Get aporteLeyes
     *
     * @return float 
     */
    public function getAporteLeyes()
    {
        return $this->aporteLeyes;
    }

    /**
     * Set porcentajeLiquidacion
     *
     * @param float $porcentajeLiquidacion
     * @return Chofer
     */
    public function setPorcentajeLiquidacion($porcentajeLiquidacion)
    {
        $this->porcentajeLiquidacion = $porcentajeLiquidacion;
    
        return $this;
    }

    /**
     * Get porcentajeLiquidacion
     *
     * @return float 
     */
    public function getPorcentajeLiquidacion()
    {
        return $this->porcentajeLiquidacion;
    }

    /**
     * Set vencCarneSalud
     *
     * @param \DateTime $vencCarneSalud
     * @return Chofer
     */
    public function setVencCarneSalud($vencCarneSalud)
    {
        $this->vencCarneSalud = $vencCarneSalud;
    
        return $this;
    }

    /**
     * Get vencCarneSalud
     *
     * @return \DateTime 
     */
    public function getVencCarneSalud()
    {
        return $this->vencCarneSalud;
    }

    /**
     * Set vencLibretaConducir
     *
     * @param \DateTime $vencLibretaConducir
     * @return Chofer
     */
    public function setVencLibretaConducir($vencLibretaConducir)
    {
        $this->vencLibretaConducir = $vencLibretaConducir;
    
        return $this;
    }

    /**
     * Get vencLibretaConducir
     *
     * @return \DateTime 
     */
    public function getVencLibretaConducir()
    {
        return $this->vencLibretaConducir;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empresas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return Chofer
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
     * @return Chofer
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
     * Add empresas
     *
     * @param \TaxiAdmin\EmpresaBundle\Entity\Empresa $empresas
     * @return Chofer
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