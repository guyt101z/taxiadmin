<?php

namespace TaxiAdmin\GastoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gasto
 *
 * @ORM\MappedSuperclass
 */
class Gasto {

    /**
     * @var float
     *
     * @ORM\Column(name="costo", type="float")
     */
    private $costo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=300, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="rubro", type="string", length=100)
     */
    private $rubro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPago", type="date", nullable=true)
     */
    private $fechaPago;

    /**
     * @var \integer
     *
     * @ORM\Column(name="diaVencimiento", type="integer", nullable=true)
     */
    private $diaVencimiento;
    


    /**
     * Set costo
     *
     * @param float $costo
     * @return Gasto
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Gasto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set rubro
     *
     * @param string $rubro
     * @return Gasto
     */
    public function setRubro($rubro)
    {
        $this->rubro = $rubro;
    
        return $this;
    }

    /**
     * Get rubro
     *
     * @return string 
     */
    public function getRubro()
    {
        return $this->rubro;
    }

    /**
     * Set fechaPago
     *
     * @param \DateTime $fechaPago
     * @return Gasto
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
     * Set diaVencimiento
     *
     * @param integer $diaVencimiento
     * @return Gasto
     */
    public function setDiaVencimiento($diaVencimiento)
    {
        $this->diaVencimiento = $diaVencimiento;
    
        return $this;
    }

    /**
     * Get diaVencimiento
     *
     * @return integer 
     */
    public function getDiaVencimiento()
    {
        return $this->diaVencimiento;
    }
}