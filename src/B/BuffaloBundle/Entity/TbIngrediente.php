<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbIngrediente
 *
 * @ORM\Table(name="tb_Ingrediente")
 * @ORM\Entity
 */
class TbIngrediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="vNOMBRE", type="string", length=45, nullable=false)
     */
    private $vnombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="iCANTIDAD", type="integer", nullable=false)
     */
    private $icantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="dCOSTO", type="float", precision=10, scale=0, nullable=false)
     */
    private $dcosto;

    /**
     * @var float
     *
     * @ORM\Column(name="dPRECIO", type="float", precision=10, scale=0, nullable=false)
     */
    private $dprecio;

    /**
     * @var string
     *
     * @ORM\Column(name="vESTADO", type="string", length=45, nullable=false)
     */
    private $vestado;



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
     * Set vnombre
     *
     * @param string $vnombre
     * @return TbIngrediente
     */
    public function setVnombre($vnombre)
    {
        $this->vnombre = $vnombre;

        return $this;
    }

    /**
     * Get vnombre
     *
     * @return string 
     */
    public function getVnombre()
    {
        return $this->vnombre;
    }

    /**
     * Set icantidad
     *
     * @param integer $icantidad
     * @return TbIngrediente
     */
    public function setIcantidad($icantidad)
    {
        $this->icantidad = $icantidad;

        return $this;
    }

    /**
     * Get icantidad
     *
     * @return integer 
     */
    public function getIcantidad()
    {
        return $this->icantidad;
    }

    /**
     * Set dcosto
     *
     * @param float $dcosto
     * @return TbIngrediente
     */
    public function setDcosto($dcosto)
    {
        $this->dcosto = $dcosto;

        return $this;
    }

    /**
     * Get dcosto
     *
     * @return float 
     */
    public function getDcosto()
    {
        return $this->dcosto;
    }

    /**
     * Set dprecio
     *
     * @param float $dprecio
     * @return TbIngrediente
     */
    public function setDprecio($dprecio)
    {
        $this->dprecio = $dprecio;

        return $this;
    }

    /**
     * Get dprecio
     *
     * @return float 
     */
    public function getDprecio()
    {
        return $this->dprecio;
    }

    /**
     * Set vestado
     *
     * @param string $vestado
     * @return TbIngrediente
     */
    public function setVestado($vestado)
    {
        $this->vestado = $vestado;

        return $this;
    }

    /**
     * Get vestado
     *
     * @return string 
     */
    public function getVestado()
    {
        return $this->vestado;
    }
             //to string method   
    public function __toString()
    {
        
    return $this->getVnombre();
    
    }
}
