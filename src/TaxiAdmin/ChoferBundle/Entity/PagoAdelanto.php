<?php

namespace TaxiAdmin\ChoferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagoAdelanto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PagoAdelanto
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
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\ChoferBundle\Entity\Adelanto", inversedBy="pagos")
     * @ORM\JoinColumn(name="adelanto_id", referencedColumnName="id")
     */
    private $adelanto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float")
     */
    private $monto;


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
     * Set pago
     *
     * @param integer $pago
     * @return PagoAdelanto
     */
    public function setPago($pago)
    {
        $this->pago = $pago;
    
        return $this;
    }

    /**
     * Get pago
     *
     * @return integer 
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return PagoAdelanto
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set monto
     *
     * @param float $monto
     * @return PagoAdelanto
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;
    
        return $this;
    }

    /**
     * Get monto
     *
     * @return float 
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set adelanto
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\Adelanto $adelanto
     * @return PagoAdelanto
     */
    public function setAdelanto(\TaxiAdmin\ChoferBundle\Entity\Adelanto $adelanto = null)
    {
        $this->adelanto = $adelanto;
    
        return $this;
    }

    /**
     * Get adelanto
     *
     * @return \TaxiAdmin\ChoferBundle\Entity\Adelanto 
     */
    public function getAdelanto()
    {
        return $this->adelanto;
    }
}