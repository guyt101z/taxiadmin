<?php

namespace TaxiAdmin\GastoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GastoEmpresa
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GastoEmpresa extends Gasto {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\EmpresaBundle\Entity\Empresa", inversedBy="gastos")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private $empresa;

    /**
     * @ORM\ManyToOne(targetEntity="TaxiAdmin\GastoBundle\Entity\PagoGasto")
     * @ORM\JoinColumn(name="pago_id", referencedColumnName="id")
     */
    private $pagos;


    /**
     * Set empresa
     *
     * @param \TaxiAdmin\EmpresaBundle\Entity\Empresa $empresa
     * @return GastoEmpresa
     */
    public function setEmpresa(\TaxiAdmin\EmpresaBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \TaxiAdmin\EmpresaBundle\Entity\Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
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
     * @param \TaxiAdmin\GastoBundle\Entity\PagoGasto $pagos
     * @return GastoEmpresa
     */
    public function addPago(\TaxiAdmin\GastoBundle\Entity\PagoGasto $pagos)
    {
        $this->pagos[] = $pagos;

        return $this;
    }

    /**
     * Remove pagos
     *
     * @param \TaxiAdmin\GastoBundle\Entity\PagoGasto $pagos
     */
    public function removePago(\TaxiAdmin\GastoBundle\Entity\PagoGasto $pagos)
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
     * @return GastoEmpresa
     */
    public function setPagos(\TaxiAdmin\GastoBundle\Entity\PagoGasto $pagos = null)
    {
        $this->pagos = $pagos;
    
        return $this;
    }
}