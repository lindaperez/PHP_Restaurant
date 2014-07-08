<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbPlato
 *
 * @ORM\Table(name="tb_Plato")
 * @ORM\Entity
 */
class TbPlato
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
     * @return TbPlato
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
     * Set dprecio
     *
     * @param float $dprecio
     * @return TbPlato
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
     * @return TbPlato
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
        
    return $this->vnombre;
    
    }
    
}
