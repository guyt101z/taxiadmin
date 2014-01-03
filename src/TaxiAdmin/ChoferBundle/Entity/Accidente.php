<?php

namespace TaxiAdmin\ChoferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accidente
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Accidente
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
     * @ORM\Column(name="chofer", type="integer")
     */
    private $chofer;

    /**
     * @var integer
     *
     * @ORM\Column(name="movil", type="integer")
     */
    private $movil;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar", type="string", length=255)
     */
    private $lugar;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=400)
     */
    private $descripcion;


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
     * @return Accidente
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
     * Set movil
     *
     * @param integer $movil
     * @return Accidente
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    
        return $this;
    }

    /**
     * Get movil
     *
     * @return integer 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Accidente
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
     * Set lugar
     *
     * @param string $lugar
     * @return Accidente
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    
        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Accidente
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
