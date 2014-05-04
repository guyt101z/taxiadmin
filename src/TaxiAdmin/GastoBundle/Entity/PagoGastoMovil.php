<?php

namespace TaxiAdmin\GastoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagoGastoMovil
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PagoGastoMovil extends PagoGasto {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\GastoBundle\Entity\GastoMovil", inversedBy="pagos")
     * @ORM\JoinColumn(name="gastoMovil_id", referencedColumnName="id")
     */
    private $gastoMovil;

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
     * Set gastoMovil
     *
     * @param \TaxiAdmin\GastoBundle\Entity\GastoMovil $gastoMovil
     * @return PagoGastoMovil
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
}