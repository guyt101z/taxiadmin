<?php

namespace TaxiAdmin\GastoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagoGasto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PagoGasto {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPago", type="date")
     */
    private $fechaPago;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaPago
     *
     * @param \DateTime $fechaPago
     * @return PagoGasto
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return PagoGasto
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
     * Set gasto
     *
     * @param \TaxiAdmin\MovilBundle\Entity\Gasto $gasto
     * @return PagoGasto
     */
    public function setGasto(\TaxiAdmin\MovilBundle\Entity\Gasto $gasto = null)
    {
        $this->gasto = $gasto;

        return $this;
    }

    /**
     * Get gasto
     *
     * @return \TaxiAdmin\MovilBundle\Entity\Gasto 
     */
    public function getGasto()
    {
        return $this->gasto;
    }

    /**
     * Set gastoEmpresa
     *
     * @param \TaxiAdmin\GastoBundle\Entity\GastoEmpresa $gastoEmpresa
     * @return PagoGasto
     */
    public function setGastoEmpresa(\TaxiAdmin\GastoBundle\Entity\GastoEmpresa $gastoEmpresa = null)
    {
        $this->gastoEmpresa = $gastoEmpresa;

        return $this;
    }

    /**
     * Get gastoEmpresa
     *
     * @return \TaxiAdmin\GastoBundle\Entity\GastoEmpresa 
     */
    public function getGastoEmpresa()
    {
        return $this->gastoEmpresa;
    }

    /**
     * Set gastoMovil
     *
     * @param \TaxiAdmin\GastoBundle\Entity\GastoMovil $gastoMovil
     * @return PagoGasto
     */
    public function setGastoMovil(\TaxiAdmin\GastoBundle\Entity\GastoMovil $gastoMovil = null)
    {
        $this->gastoMovil = $gastoMovil;

        return $this;
    }

    /**
     * Get gastoMovil
     *
     * @return \TaxiAdmin\GastoBundle\Entity\GastoMovil 
     */
    public function getGastoMovil()
    {
        return $this->gastoMovil;
    }

    /**
     * Set costo
     *
     * @param float $costo
     * @return PagoGasto
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
}