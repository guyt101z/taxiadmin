<?php

namespace TaxiAdmin\MovilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GastoRecaudacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GastoRecaudacion
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
     * @ORM\Column(name="recaudacion", type="integer")
     */
    private $recaudacion;

    /**
     * @var float
     *
     * @ORM\Column(name="costo", type="float")
     */
    private $costo;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=255)
     */
    private $detalle;


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
     * Set recaudacion
     *
     * @param integer $recaudacion
     * @return GastoRecaudacion
     */
    public function setRecaudacion($recaudacion)
    {
        $this->recaudacion = $recaudacion;
    
        return $this;
    }

    /**
     * Get recaudacion
     *
     * @return integer 
     */
    public function getRecaudacion()
    {
        return $this->recaudacion;
    }

    /**
     * Set costo
     *
     * @param float $costo
     * @return GastoRecaudacion
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
     * Set detalle
     *
     * @param string $detalle
     * @return GastoRecaudacion
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    
        return $this;
    }

    /**
     * Get detalle
     *
     * @return string 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }
}
