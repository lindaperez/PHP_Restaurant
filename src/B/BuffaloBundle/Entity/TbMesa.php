<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbMesa
 *
 * @ORM\Table(name="tb_Mesa", indexes={@ORM\Index(name="fk_iID_ESTADO_MESA", columns={"fk_iID_ESTADO_MESA"})})
 * @ORM\Entity
 */
class TbMesa
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
     * @var integer
     *
     * @ORM\Column(name="iNRO_MESA", type="integer", nullable=false)
     */
    private $inroMesa;

    /**
     * @var string
     *
     * @ORM\Column(name="dESTATUS", type="string", length=45, nullable=false)
     */
    private $destatus;

    /**
     * @var \B\BuffaloBundle\Entity\TbEstadoMesa
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbEstadoMesa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_ESTADO_MESA", referencedColumnName="id")
     * })
     */
    private $fkIidEstadoMesa;



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
     * Set inroMesa
     *
     * @param integer $inroMesa
     * @return TbMesa
     */
    public function setInroMesa($inroMesa)
    {
        $this->inroMesa = $inroMesa;

        return $this;
    }

    /**
     * Get inroMesa
     *
     * @return integer 
     */
    public function getInroMesa()
    {
        return $this->inroMesa;
    }

    /**
     * Set destatus
     *
     * @param string $destatus
     * @return TbMesa
     */
    public function setDestatus($destatus)
    {
        $this->destatus = $destatus;

        return $this;
    }

    /**
     * Get destatus
     *
     * @return string 
     */
    public function getDestatus()
    {
        return $this->destatus;
    }

    /**
     * Set fkIidEstadoMesa
     *
     * @param \B\BuffaloBundle\Entity\TbEstadoMesa $fkIidEstadoMesa
     * @return TbMesa
     */
    public function setFkIidEstadoMesa(\B\BuffaloBundle\Entity\TbEstadoMesa $fkIidEstadoMesa = null)
    {
        $this->fkIidEstadoMesa = $fkIidEstadoMesa;

        return $this;
    }

    /**
     * Get fkIidEstadoMesa
     *
     * @return \B\BuffaloBundle\Entity\TbEstadoMesa 
     */
    public function getFkIidEstadoMesa()
    {
        return $this->fkIidEstadoMesa;
    }
          //to string method   
    public function __toString()
    {
        
    return strval($this->getInroMesa());
    
}
    
}
