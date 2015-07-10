<?php

namespace V\ValoraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbRelPaqueteProducto
 *
 * @ORM\Table(name="tb_Rel_Paquete_Producto", indexes={@ORM\Index(name="fk_Paquete", columns={"fk_Paquete"}), @ORM\Index(name="fk_Producto", columns={"fk_Producto"})})
 * @ORM\Entity
 */
class TbRelPaqueteProducto
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
     * @ORM\Column(name="iCantidad_Producto_Paquete", type="integer", nullable=false)
     */
    private $icantidadProductoPaquete;

    /**
     * @var \V\ValoraBundle\Entity\TbProducto
     *
     * @ORM\ManyToOne(targetEntity="V\ValoraBundle\Entity\TbProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Producto", referencedColumnName="id")
     * })
     */
    private $fkProducto;

    /**
     * @var \V\ValoraBundle\Entity\TbPaquete
     *
     * @ORM\ManyToOne(targetEntity="V\ValoraBundle\Entity\TbPaquete")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Paquete", referencedColumnName="id")
     * })
     */
    private $fkPaquete;



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
     * Set icantidadProductoPaquete
     *
     * @param integer $icantidadProductoPaquete
     * @return TbRelPaqueteProducto
     */
    public function setIcantidadProductoPaquete($icantidadProductoPaquete)
    {
        $this->icantidadProductoPaquete = $icantidadProductoPaquete;

        return $this;
    }

    /**
     * Get icantidadProductoPaquete
     *
     * @return integer 
     */
    public function getIcantidadProductoPaquete()
    {
        return $this->icantidadProductoPaquete;
    }

    /**
     * Set fkProducto
     *
     * @param \V\ValoraBundle\Entity\TbProducto $fkProducto
     * @return TbRelPaqueteProducto
     */
    public function setFkProducto(\V\ValoraBundle\Entity\TbProducto $fkProducto = null)
    {
        $this->fkProducto = $fkProducto;

        return $this;
    }

    /**
     * Get fkProducto
     *
     * @return \V\ValoraBundle\Entity\TbProducto 
     */
    public function getFkProducto()
    {
        return $this->fkProducto;
    }

    /**
     * Set fkPaquete
     *
     * @param \V\ValoraBundle\Entity\TbPaquete $fkPaquete
     * @return TbRelPaqueteProducto
     */
    public function setFkPaquete(\V\ValoraBundle\Entity\TbPaquete $fkPaquete = null)
    {
        $this->fkPaquete = $fkPaquete;

        return $this;
    }

    /**
     * Get fkPaquete
     *
     * @return \V\ValoraBundle\Entity\TbPaquete 
     */
    public function getFkPaquete()
    {
        return $this->fkPaquete;
    }
}
