<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbCompra
 *
 * @ORM\Table(name="tb_Compra", indexes={@ORM\Index(name="fk_tb_Compra_Persona", columns={"fk_iID_PERSONA"}), @ORM\Index(name="fk_tb_Mesa", columns={"fk_iID_MESA"})})
 * @ORM\Entity
 */
class TbCompra
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
     * @var \DateTime
     *
     * @ORM\Column(name="dtFECHA_COMPRA", type="datetime", nullable=false)
     */
    private $dtfechaCompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="iCANTIDAD", type="integer", nullable=false)
     */
    private $icantidad;

    /**
     * @var \B\BuffaloBundle\Entity\TbPersona
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_PERSONA", referencedColumnName="id")
     * })
     */
    private $fkIidPersona;

    /**
     * @var \B\BuffaloBundle\Entity\TbMesa
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbMesa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_MESA", referencedColumnName="id")
     * })
     */
    private $fkIidMesa;



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
     * Set dtfechaCompra
     *
     * @param \DateTime $dtfechaCompra
     * @return TbCompra
     */
    public function setDtfechaCompra($dtfechaCompra)
    {
        $this->dtfechaCompra = $dtfechaCompra;

        return $this;
    }

    /**
     * Get dtfechaCompra
     *
     * @return \DateTime 
     */
    public function getDtfechaCompra()
    {
        return $this->dtfechaCompra;
    }

    /**
     * Set icantidad
     *
     * @param integer $icantidad
     * @return TbCompra
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
     * Set fkIidPersona
     *
     * @param \B\BuffaloBundle\Entity\TbPersona $fkIidPersona
     * @return TbCompra
     */
    public function setFkIidPersona(\B\BuffaloBundle\Entity\TbPersona $fkIidPersona = null)
    {
        $this->fkIidPersona = $fkIidPersona;

        return $this;
    }

    /**
     * Get fkIidPersona
     *
     * @return \B\BuffaloBundle\Entity\TbPersona 
     */
    public function getFkIidPersona()
    {
        return $this->fkIidPersona;
    }

    /**
     * Set fkIidMesa
     *
     * @param \B\BuffaloBundle\Entity\TbMesa $fkIidMesa
     * @return TbCompra
     */
    public function setFkIidMesa(\B\BuffaloBundle\Entity\TbMesa $fkIidMesa = null)
    {
        $this->fkIidMesa = $fkIidMesa;

        return $this;
    }

    /**
     * Get fkIidMesa
     *
     * @return \B\BuffaloBundle\Entity\TbMesa 
     */
    public function getFkIidMesa()
    {
        return $this->fkIidMesa;
    }
        public function __toString()
    {
        
    return strval($this->getId());
    
    }
}
