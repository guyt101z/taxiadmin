<?php

namespace TaxiAdmin\GastoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagoGastoEmpresa
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PagoGastoEmpresa extends PagoGasto {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\GastoBundle\Entity\GastoEmpresa", inversedBy="pagos")
     * @ORM\JoinColumn(name="gastoEmpresa_id", referencedColumnName="id")
     */
    private $gastoEmpresa;


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
     * Set gastoEmpresa
     *
     * @param \TaxiAdmin\GastoBundle\Entity\GastoEmpresa $gastoEmpresa
     * @return PagoGastoEmpresa
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
}