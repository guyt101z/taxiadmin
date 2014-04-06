<?php

namespace TaxiAdmin\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Empresa
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TaxiAdmin\EmpresaBundle\Entity\EmpresaRepository")
 * @UniqueEntity("razonSocial")
 */
class Empresa {

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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="razonSocial", type="string", length=100)
     */
    private $razonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="habilitado", type="boolean")
     */
    private $habilitado;

    /**
     * @var string
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
     * @ORM\ManyToMany(targetEntity="TaxiAdmin\PropietarioBundle\Entity\Propietario", inversedBy="empresas")
     * @ORM\JoinTable(name="empresa_propietario")
     */
    private $propietarios;

    /**
     * @ORM\ManyToMany(targetEntity="TaxiAdmin\ChoferBundle\Entity\Chofer", inversedBy="empresas")
     * @ORM\JoinTable(name="empresa_chofer")
     */
    private $choferes;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\MovilBundle\Entity\Movil", mappedBy="empresa")
     */
    private $moviles;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\GastoBundle\Entity\GastoEmpresa", mappedBy="empresa")
     */
    private $gastos;


    public function __toString(){
        return $this->nombre;
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
     * @return Empresa
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
     * Set razonSocial
     *
     * @param string $razonSocial
     * @return Empresa
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;
    
        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string 
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return Empresa
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
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return Empresa
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
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Empresa
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
     * @return Empresa
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
     * Constructor
     */
    public function __construct()
    {
        $this->propietarios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add propietarios
     *
     * @param \TaxiAdmin\PropietarioBundle\Entity\Propietario $propietarios
     * @return Empresa
     */
    public function addPropietario(\TaxiAdmin\PropietarioBundle\Entity\Propietario $propietarios)
    {
        $this->propietarios[] = $propietarios;
    
        return $this;
    }

    /**
     * Remove propietarios
     *
     * @param \TaxiAdmin\PropietarioBundle\Entity\Propietario $propietarios
     */
    public function removePropietario(\TaxiAdmin\PropietarioBundle\Entity\Propietario $propietarios)
    {
        $this->propietarios->removeElement($propietarios);
    }

    /**
     * Get propietarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPropietarios()
    {
        return $this->propietarios;
    }

    /**
     * Add choferes
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Chofer $choferes
     * @return Empresa
     */
    public function addChofer(\TaxiAdmin\ChoferBundle\Entity\Chofer $choferes)
    {
        $this->choferes[] = $choferes;
    
        return $this;
    }

    /**
     * Remove choferes
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Chofer $choferes
     */
    public function removeChofer(\TaxiAdmin\ChoferBundle\Entity\Chofer $choferes)
    {
        $this->choferes->removeElement($choferes);
    }

    /**
     * Get choferes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChoferes()
    {
        return $this->choferes;
    }

    /**
     * Add choferes
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Chofer $choferes
     * @return Empresa
     */
    public function addChofere(\TaxiAdmin\ChoferBundle\Entity\Chofer $choferes)
    {
        $this->choferes[] = $choferes;
    
        return $this;
    }

    /**
     * Remove choferes
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Chofer $choferes
     */
    public function removeChofere(\TaxiAdmin\ChoferBundle\Entity\Chofer $choferes)
    {
        $this->choferes->removeElement($choferes);
    }

    /**
     * Add moviles
     *
     * @param \TaxiAdmin\MovilBundle\Entity\Movil $moviles
     * @return Empresa
     */
    public function addMovile(\TaxiAdmin\MovilBundle\Entity\Movil $moviles)
    {
        $this->moviles[] = $moviles;
    
        return $this;
    }

    /**
     * Remove moviles
     *
     * @param \TaxiAdmin\MovilBundle\Entity\Movil $moviles
     */
    public function removeMovile(\TaxiAdmin\MovilBundle\Entity\Movil $moviles)
    {
        $this->moviles->removeElement($moviles);
    }

    /**
     * Get moviles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMoviles()
    {
        return $this->moviles;
    }


    /**
     * Get gastos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGastos()
    {
        return $this->gastos;
    }

    /**
     * Add gastos
     *
     * @param \TaxiAdmin\GastoBundle\Entity\GastoEmpresa $gastos
     * @return Empresa
     */
    public function addGasto(\TaxiAdmin\GastoBundle\Entity\GastoEmpresa $gastos)
    {
        $this->gastos[] = $gastos;
    
        return $this;
    }

    /**
     * Remove gastos
     *
     * @param \TaxiAdmin\GastoBundle\Entity\GastoEmpresa $gastos
     */
    public function removeGasto(\TaxiAdmin\GastoBundle\Entity\GastoEmpresa $gastos)
    {
        $this->gastos->removeElement($gastos);
    }
}