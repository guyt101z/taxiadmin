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
     * @ORM\Column(name="descripcion", type="string", length=300)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="rubro", type="string", length=100, nullable=false)
     */
    private $rubro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaVencimiento", type="date")
     */
    private $fechaVencimiento;
        /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPago", type="date")
     */
    private $fechaPago;

    /**
     * @var \boolean
     *
     * @ORM\Column(name="mensual", type="boolean")
     */
    private $mensual;

    /**
     * @var \integer
     *
     * @ORM\Column(name="diaVencimiento", type="integer")
     */
    private $diaVencimiento;
    

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
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     * @return Gasto
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
     * Set mensual
     *
     * @param boolean $mensual
     * @return Gasto
     */
    public function setMensual($mensual)
    {
        $this->mensual = $mensual;
    
        return $this;
    }

    /**
     * Get mensual
     *
     * @return boolean 
     */
    public function getMensual()
    {
        return $this->mensual;
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
     * Set pago
     *
     * @param \TaxiAdmin\GastoBundle\Entity\PagoGasto $pago
     * @return Gasto
     */
    public function setPago(\TaxiAdmin\GastoBundle\Entity\PagoGasto $pago = null)
    {
        $this->pago = $pago;
    
        return $this;
    }

    /**
     * Get pago
     *
     * @return \TaxiAdmin\GastoBundle\Entity\PagoGasto 
     */
    public function getPago()
    {
        return $this->pago;
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
}