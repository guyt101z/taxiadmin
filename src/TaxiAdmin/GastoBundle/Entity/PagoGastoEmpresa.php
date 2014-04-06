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
     * @var integer
     *
     * @ORM\Column(name="gastoempresa_id", type="integer")
     */
    private $gastoempresa_id;


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
     * Set empresa_id
     *
     * @param integer $empresaId
     * @return PagoGastoEmpresa
     */
    public function setEmpresaId($empresaId)
    {
        $this->empresa_id = $empresaId;
    
        return $this;
    }

    /**
     * Get empresa_id
     *
     * @return integer 
     */
    public function getEmpresaId()
    {
        return $this->empresa_id;
    }

    /**
     * Set gastoempresa_id
     *
     * @param integer $gastoempresaId
     * @return PagoGastoEmpresa
     */
    public function setGastoempresaId($gastoempresaId)
    {
        $this->gastoempresa_id = $gastoempresaId;
    
        return $this;
    }

    /**
     * Get gastoempresa_id
     *
     * @return integer 
     */
    public function getGastoempresaId()
    {
        return $this->gastoempresa_id;
    }
}