<?php

namespace TaxiAdmin\GastoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GastoMovil
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GastoMovil extends Gasto {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\MovilBundle\Entity\Movil", inversedBy="gastos")
     * @ORM\JoinColumn(name="movil_id", referencedColumnName="id")
     */
    private $movil;

    /**
     * @ORM\OneToMany(targetEntity="TaxiAdmin\GastoBundle\Entity\PagoGastoMovil", mappedBy="gastoMovil")
     */
    private $pagos;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pagos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set movil
     *
     * @param \TaxiAdmin\MovilBundle\Entity\Movil $movil
     * @return GastoMovil
     */
    public function setMovil(\TaxiAdmin\MovilBundle\Entity\Movil $movil = null)
    {
        $this->movil = $movil;
    
        return $this;
    }

    /**
     * Get movil
     *
     * @return \TaxiAdmin\MovilBundle\Entity\Movil 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Add pagos
     *
     * @param \TaxiAdmin\GastoBundle\Entity\PagoGastoMovil $pagos
     * @return GastoMovil
     */
    public function addPago(\TaxiAdmin\GastoBundle\Entity\PagoGastoMovil $pagos)
    {
        $this->pagos[] = $pagos;
    
        return $this;
    }

    /**
     * Remove pagos
     *
     * @param \TaxiAdmin\GastoBundle\Entity\PagoGastoMovil $pagos
     */
    public function removePago(\TaxiAdmin\GastoBundle\Entity\PagoGastoMovil $pagos)
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
}