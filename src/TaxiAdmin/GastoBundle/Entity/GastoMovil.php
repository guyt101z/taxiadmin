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
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\MovilBundle\Entity\Movil", inversedBy="gastos")
     * @ORM\JoinColumn(name="movil_id", referencedColumnName="id")
     */
    private $movil;
    

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
}