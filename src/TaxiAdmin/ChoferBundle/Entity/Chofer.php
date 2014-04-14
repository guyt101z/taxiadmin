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
     * @ORM\Column(name="aporteLeyes", type="float", nullable=true)
     */
    private $aporteLeyes;

    /**
     * @var float
     *
     * @ORM\Column(name="porcentajeLiquidacion", type="float", nullable=true)
     */
    private $porcentajeLiquidacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencCarneSalud", type="datetime", nullable=true)
     */
    private $vencCarneSalud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencLibretaConducir", type="datetime", nullable=true)
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
     * @ORM\OneToMany(targetEntity="TaxiAdmin\ChoferBundle\Entity\Adelanto", mappedBy="chofer")
     * @ORM\OrderBy({"fecha" = "DESC"})
     */
    private $adelantos;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\ChoferBundle\Entity\Accidente", mappedBy="chofer")
     * @ORM\OrderBy({"fecha" = "DESC"})
     */
    private $accidentes;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\ChoferBundle\Entity\Multa", mappedBy="chofer")
     * @ORM\OrderBy({"fecha" = "DESC"})
     */
    private $multas;


    public function __toString(){
        return parent::__toString();
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

    /**
     * Add accidentes
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Accidente $accidentes
     * @return Chofer
     */
    public function addAccidente(\TaxiAdmin\ChoferBundle\Entity\Accidente $accidentes)
    {
        $this->accidentes[] = $accidentes;
    
        return $this;
    }

    /**
     * Remove accidentes
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Accidente $accidentes
     */
    public function removeAccidente(\TaxiAdmin\ChoferBundle\Entity\Accidente $accidentes)
    {
        $this->accidentes->removeElement($accidentes);
    }

    /**
     * Get accidentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccidentes()
    {
        return $this->accidentes;
    }

    /**
     * Add multas
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Multa $multas
     * @return Chofer
     */
    public function addMulta(\TaxiAdmin\ChoferBundle\Entity\Multa $multas)
    {
        $this->multas[] = $multas;
    
        return $this;
    }

    /**
     * Remove multas
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Multa $multas
     */
    public function removeMulta(\TaxiAdmin\ChoferBundle\Entity\Multa $multas)
    {
        $this->multas->removeElement($multas);
    }

    /**
     * Get multas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMultas()
    {
        return $this->multas;
    }

    /**
     * Add adelantos
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Adelanto $adelantos
     * @return Chofer
     */
    public function addAdelanto(\TaxiAdmin\ChoferBundle\Entity\Adelanto $adelantos)
    {
        $this->adelantos[] = $adelantos;
    
        return $this;
    }

    /**
     * Remove adelantos
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Adelanto $adelantos
     */
    public function removeAdelanto(\TaxiAdmin\ChoferBundle\Entity\Adelanto $adelantos)
    {
        $this->adelantos->removeElement($adelantos);
    }

    /**
     * Get adelantos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdelantos()
    {
        return $this->adelantos;
    }
}