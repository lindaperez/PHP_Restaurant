<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * TbCompra
 *
 * @ORM\Table(name="tb_Compra", indexes={@ORM\Index(name="fk_tb_Compra_Persona", columns={"fk_iID_PERSONA"}), @ORM\Index(name="fk_tb_Mesa", columns={"fk_iID_MESA"}), @ORM\Index(name="fk_tb_Compra_1", columns={"fk_iID_ESTADO_COMPRA"})})
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
     * @var float
     *
     * @ORM\Column(name="dCOSTO", type="float", precision=10, scale=0, nullable=false)
     */
    private $dcosto;

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
     * @var \B\BuffaloBundle\Entity\TbEstadoCompra
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbEstadoCompra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_ESTADO_COMPRA", referencedColumnName="id")
     * })
     */
    private $fkIidEstadoCompra;



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
     * Set dcosto
     *
     * @param float $dcosto
     * @return TbCompra
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

    /**
     * Set fkIidEstadoCompra
     *
     * @param \B\BuffaloBundle\Entity\TbEstadoCompra $fkIidEstadoCompra
     * @return TbCompra
     */
    public function setFkIidEstadoCompra(\B\BuffaloBundle\Entity\TbEstadoCompra $fkIidEstadoCompra = null)
    {
        $this->fkIidEstadoCompra = $fkIidEstadoCompra;

        return $this;
    }

    /**
     * Get fkIidEstadoCompra
     *
     * @return \B\BuffaloBundle\Entity\TbEstadoCompra 
     */
    public function getFkIidEstadoCompra()
    {
        return $this->fkIidEstadoCompra;
    }
          public function __toString()
    {
        
    return strval($this->getId());
    
    }
    protected $platos; 
    
    public function __construct()
    {
        $this->platos = new ArrayCollection();
        
    }
    
  
    public function addPlato(TbRelCompraPlato $plato=null)
    {
        //$plato->addRelCompraPlato($this);
        if ($this->platos==null){
            
           $this->platos=new ArrayCollection();
        }
        $this->platos->add($plato);
    }

    public function removePlato(TbRelCompraPlato $plato=null)
    {
        if ($this->platos!=null){
         $this->platos->removeElement($plato);
    
        }
    }
    
   
    
    public function getPlatos()
    {
        return $this->platos;
    }
    public function setPlatos($platos)
    {       
           $this->platos=$platos;

    }
}
