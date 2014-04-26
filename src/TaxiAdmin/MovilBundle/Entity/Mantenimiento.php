<?php

namespace TaxiAdmin\MovilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mantenimiento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mantenimiento
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
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\MovilBundle\Entity\Movil", inversedBy="mantenimientos")
     * @ORM\JoinColumn(name="movil_id", referencedColumnName="id")
     */
    private $movil;

    /**
     * @var string
     *
     * @ORM\Column(name="motivoIngreso", type="string", length=255)
     */
    private $motivoIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="taller", type="string", length=255, nullable=true)
     */
    private $taller;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcionTrabajo", type="string", length=500, nullable=true)
     */
    private $descripcionTrabajo;

    /**
     * @var float
     *
     * @ORM\Column(name="costo", type="float")
     */
    private $costo;


    /**
     * @var \integer
     *
     * @ORM\Column(name="kmIngreso", type="integer", nullable=true)
     */
    private $kmIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIngreso", type="date")
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFinalizado", type="date", nullable=true)
     */
    private $fechaFinalizado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPago", type="date", nullable=true)
     */
    private $fechaPago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaVencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;


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
     * Set movil
     *
     * @param integer $movil
     * @return Mantenimiento
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    
        return $this;
    }

    /**
     * Get movil
     *
     * @return integer 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     * @return Mantenimiento
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
    
        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime 
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set motivoIngreso
     *
     * @param string $motivoIngreso
     * @return Mantenimiento
     */
    public function setMotivoIngreso($motivoIngreso)
    {
        $this->motivoIngreso = $motivoIngreso;
    
        return $this;
    }

    /**
     * Get motivoIngreso
     *
     * @return string 
     */
    public function getMotivoIngreso()
    {
        return $this->motivoIngreso;
    }

    /**
     * Set taller
     *
     * @param string $taller
     * @return Mantenimiento
     */
    public function setTaller($taller)
    {
        $this->taller = $taller;
    
        return $this;
    }

    /**
     * Get taller
     *
     * @return string 
     */
    public function getTaller()
    {
        return $this->taller;
    }

    /**
     * Set descripcionTrabajo
     *
     * @param string $descripcionTrabajo
     * @return Mantenimiento
     */
    public function setDescripcionTrabajo($descripcionTrabajo)
    {
        $this->descripcionTrabajo = $descripcionTrabajo;
    
        return $this;
    }

    /**
     * Get descripcionTrabajo
     *
     * @return string 
     */
    public function getDescripcionTrabajo()
    {
        return $this->descripcionTrabajo;
    }

    /**
     * Set costo
     *
     * @param float $costo
     * @return Mantenimiento
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
    
        return $this;
    }

    /**
     * Get costo
     *
     * @return float 
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set fechaFinalizado
     *
     * @param \DateTime $fechaFinalizado
     * @return Mantenimiento
     */
    public function setFechaFinalizado($fechaFinalizado)
    {
        $this->fechaFinalizado = $fechaFinalizado;
    
        return $this;
    }

    /**
     * Get fechaFinalizado
     *
     * @return \DateTime 
     */
    public function getFechaFinalizado()
    {
        return $this->fechaFinalizado;
    }

    /**
     * Set fechaPago
     *
     * @param \DateTime $fechaPago
     * @return Mantenimiento
     */
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;
    
        return $this;
    }

    /**
     * Get fechaPago
     *
     * @return \DateTime 
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     * @return Mantenimiento
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;
    
        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime 
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set kmIngreso
     *
     * @param integer $kmIngreso
     * @return Mantenimiento
     */
    public function setKmIngreso($kmIngreso)
    {
        $this->kmIngreso = $kmIngreso;
    
        return $this;
    }

    /**
     * Get kmIngreso
     *
     * @return integer 
     */
    public function getKmIngreso()
    {
        return $this->kmIngreso;
    }
}