<?php

namespace TaxiAdmin\ChoferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adelanto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TaxiAdmin\ChoferBundle\Entity\AdelantoRepository")
 */
class Adelanto
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
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\ChoferBundle\Entity\Chofer", inversedBy="adelantos")
     * @ORM\JoinColumn(name="chofer_id", referencedColumnName="id")
     */
    private $chofer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float")
     */
    private $monto;

    /**
     * @var float
     *
     * @ORM\Column(name="saldo", type="float")
     */
    private $saldo;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=150)
     */
    private $detalle;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\ChoferBundle\Entity\PagoAdelanto", mappedBy="adelanto")
     * @ORM\OrderBy({"fecha" = "ASC"})
     */
    private $pagos;


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
     * Set chofer
     *
     * @param integer $chofer
     * @return Adelanto
     */
    public function setChofer($chofer)
    {
        $this->chofer = $chofer;
    
        return $this;
    }

    /**
     * Get chofer
     *
     * @return integer 
     */
    public function getChofer()
    {
        return $this->chofer;
    }

    /**
     * Set monto
     *
     * @param float $monto
     * @return Adelanto
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
     * Set detalle
     *
     * @param string $detalle
     * @return Adelanto
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

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Adelanto
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
     * Set pago
     *
     * @param boolean $pago
     * @return Adelanto
     */
    public function setPago($pago)
    {
        $this->pago = $pago;
    
        return $this;
    }

    /**
     * Get pago
     *
     * @return boolean 
     */
    public function getPago()
    {
        return $this->pago;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pagos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add pagos
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\PagoAdelanto $pagos
     * @return Adelanto
     */
    public function addPago(\TaxiAdmin\ChoferBundle\Entity\PagoAdelanto $pagos)
    {
        $this->pagos[] = $pagos;
    
        return $this;
    }

    /**
     * Remove pagos
     *
     * @param \TaxiAdmin\ChoferBundle\Entity\PagoAdelanto $pagos
     */
    public function removePago(\TaxiAdmin\ChoferBundle\Entity\PagoAdelanto $pagos)
    {
        $this->pagos->removeElement($pagos);
    }

    /**
     * Get pagos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * Set saldo
     *
     * @param float $saldo
     * @return Adelanto
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    
        return $this;
    }

    /**
     * Get saldo
     *
     * @return float 
     */
    public function getSaldo()
    {
        return $this->saldo;
    }
}