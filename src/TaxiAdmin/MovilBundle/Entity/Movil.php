<?php

namespace TaxiAdmin\MovilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Movil
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TaxiAdmin\MovilBundle\Entity\MovilRepository")
  * @UniqueEntity("matricula")
 */
class Movil
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
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="string", length=15)
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=100)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=100)
     */
    private $modelo;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @var string
     *
     * @ORM\Column(name="numChasis", type="string", length=200)
     */
    private $numChasis;

    /**
     * @var string
     *
     * @ORM\Column(name="combustible", type="string", length=100)
     */
    private $combustible;

    /**
     * @var string
     *
     * @ORM\Column(name="numMovil", type="string", length=10)
     */
    private $numMovil;

    /**
     * @var string
     *
     * @ORM\Column(name="despacho", type="string", length=100)
     */
    private $despacho;

        /**
     * @var string
     *
     * @ORM\Column(name="radio", type="string", length=100)
     */
    private $radio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean")
     */
    private $habilitado;

    /**
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\EmpresaBundle\Entity\Empresa", inversedBy="moviles")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
     private $empresa;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\ChoferBundle\Entity\Accidente", mappedBy="movil")
     * @ORM\OrderBy({"fecha" = "DESC"})
     */
    private $accidentes;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\ChoferBundle\Entity\Multa", mappedBy="movil")
     * @ORM\OrderBy({"fecha" = "DESC"})
     */
    private $multas;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\MovilBundle\Entity\Mantenimiento", mappedBy="movil")
     * @ORM\OrderBy({"fechaIngreso" = "DESC"})
     */
    private $mantenimientos;



    /**
     * Constructor
     */
    public function __construct() {
        $this->empresa = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->matricula;
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
     * Set matricula
     *
     * @param string $matricula
     * @return Movil
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    /**
     * Get matricula
     *
     * @return string 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set marca
     *
     * @param string $marca
     * @return Movil
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Movil
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    
        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set anio
     *
     * @param integer $anio
     * @return Movil
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
    
        return $this;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set numChasis
     *
     * @param integer $numChasis
     * @return Movil
     */
    public function setNumChasis($numChasis)
    {
        $this->numChasis = $numChasis;
    
        return $this;
    }

    /**
     * Get numChasis
     *
     * @return integer 
     */
    public function getNumChasis()
    {
        return $this->numChasis;
    }

    /**
     * Set combustible
     *
     * @param string $combustible
     * @return Movil
     */
    public function setCombustible($combustible)
    {
        $this->combustible = $combustible;
    
        return $this;
    }

    /**
     * Get combustible
     *
     * @return string 
     */
    public function getCombustible()
    {
        return $this->combustible;
    }

    /**
     * Set numMovil
     *
     * @param string $numMovil
     * @return Movil
     */
    public function setNumMovil($numMovil)
    {
        $this->numMovil = $numMovil;
    
        return $this;
    }

    /**
     * Get numMovil
     *
     * @return string 
     */
    public function getNumMovil()
    {
        return $this->numMovil;
    }

    /**
     * Set despacho
     *
     * @param string $despacho
     * @return Movil
     */
    public function setDespacho($despacho)
    {
        $this->despacho = $despacho;
    
        return $this;
    }

    /**
     * Get despacho
     *
     * @return string 
     */
    public function getDespacho()
    {
        return $this->despacho;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Movil
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    
        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaBaja
     *
     * @param \DateTime $fechaBaja
     * @return Movil
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    
        return $this;
    }

    /**
     * Get fechaBaja
     *
     * @return \DateTime 
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return Movil
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;
    
        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean 
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set radio
     *
     * @param string $radio
     * @return Movil
     */
    public function setRadio($radio)
    {
        $this->radio = $radio;
    
        return $this;
    }

    /**
     * Get radio
     *
     * @return string 
     */
    public function getRadio()
    {
        return $this->radio;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return Movil
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
     * Add empresa
     *
     * @param \TaxiAdmin\EmpresaBundle\Entity\Empresa $empresa
     * @return Movil
     */
    public function addEmpresa(\TaxiAdmin\EmpresaBundle\Entity\Empresa $empresa)
    {
        $this->empresa[] = $empresa;
    
        return $this;
    }

    /**
     * Remove empresa
     *
     * @param \TaxiAdmin\EmpresaBundle\Entity\Empresa $empresa
     */
    public function removeEmpresa(\TaxiAdmin\EmpresaBundle\Entity\Empresa $empresa)
    {
        $this->empresa->removeElement($empresa);
    }

    /**
     * Get empresa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set empresa
     *
     * @param \TaxiAdmin\EmpresaBundle\Entity\Empresa $empresa
     * @return Movil
     */
    public function setEmpresa(\TaxiAdmin\EmpresaBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Add accidentes
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Accidente $accidentes
     * @return Movil
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
     * @return Movil
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
}