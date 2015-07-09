<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbPlato
 *
 * @ORM\Table(name="tb_Plato", indexes={@ORM\Index(name="fk_iID_ESTADO", columns={"fk_iID_ESTADO"})})
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
     * @var \B\BuffaloBundle\Entity\TbEstadoPlato
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbEstadoPlato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_ESTADO", referencedColumnName="id")
     * })
     */
    private $fkIidEstado;



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
     * Set fkIidEstado
     *
     * @param \B\BuffaloBundle\Entity\TbEstadoPlato $fkIidEstado
     * @return TbPlato
     */
    public function setFkIidEstado(\B\BuffaloBundle\Entity\TbEstadoPlato $fkIidEstado = null)
    {
        $this->fkIidEstado = $fkIidEstado;

        return $this;
    }

    /**
     * Get fkIidEstado
     *
     * @return \B\BuffaloBundle\Entity\TbEstadoPlato 
     */
    public function getFkIidEstado()
    {
        return $this->fkIidEstado;
    }
             //to string method   
    public function __toString()
    {
        
    return $this->vnombre;
    
}

    
}
