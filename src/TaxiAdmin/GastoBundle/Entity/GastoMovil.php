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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pagos
     *
     * @param \TaxiAdmin\GastoBundle\Entity\PagoGasto $pagos
     * @return GastoMovil
     */
    public function setPagos(\TaxiAdmin\GastoBundle\Entity\PagoGasto $pagos = null)
    {
        $this->pagos = $pagos;
    
        return $this;
    }

    /**
     * Get pagos
     *
     * @return \TaxiAdmin\GastoBundle\Entity\PagoGasto 
     */
    public function getPagos()
    {
        return $this->pagos;
    }
}