<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbIngrediente
 *
 * @ORM\Table(name="tb_Ingrediente", indexes={@ORM\Index(name="fk_iID_ESTADO_ING", columns={"fk_iID_ESTADO_ING"}), @ORM\Index(name="fk_iID_MEDIDA_ING", columns={"fk_iID_MEDIDA_ING"})})
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
     * @var \B\BuffaloBundle\Entity\TbEstadoIng
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbEstadoIng")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_ESTADO_ING", referencedColumnName="id")
     * })
     */
    private $fkIidEstadoIng;

    /**
     * @var \B\BuffaloBundle\Entity\TbMedida
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbMedida")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_MEDIDA_ING", referencedColumnName="id")
     * })
     */
    private $fkIidMedidaIng;



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
     * Set fkIidEstadoIng
     *
     * @param \B\BuffaloBundle\Entity\TbEstadoIng $fkIidEstadoIng
     * @return TbIngrediente
     */
    public function setFkIidEstadoIng(\B\BuffaloBundle\Entity\TbEstadoIng $fkIidEstadoIng = null)
    {
        $this->fkIidEstadoIng = $fkIidEstadoIng;

        return $this;
    }

    /**
     * Get fkIidEstadoIng
     *
     * @return \B\BuffaloBundle\Entity\TbEstadoIng 
     */
    public function getFkIidEstadoIng()
    {
        return $this->fkIidEstadoIng;
    }

    /**
     * Set fkIidMedidaIng
     *
     * @param \B\BuffaloBundle\Entity\TbMedida $fkIidMedidaIng
     * @return TbIngrediente
     */
    public function setFkIidMedidaIng(\B\BuffaloBundle\Entity\TbMedida $fkIidMedidaIng = null)
    {
        $this->fkIidMedidaIng = $fkIidMedidaIng;

        return $this;
    }

    /**
     * Get fkIidMedidaIng
     *
     * @return \B\BuffaloBundle\Entity\TbMedida 
     */
    public function getFkIidMedidaIng()
    {
        return $this->fkIidMedidaIng;
    }
 public function __toString()
    {
        
    return $this->getVnombre();
    
    }
    
    }
