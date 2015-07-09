<?php

namespace V\ValoraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbProducto
 *
 * @ORM\Table(name="tb_Producto")
 * @ORM\Entity
 */
class TbProducto
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
     * @var float
     *
     * @ORM\Column(name="vMonto", type="float", precision=10, scale=0, nullable=false)
     */
    private $vmonto;

    /**
     * @var float
     *
     * @ORM\Column(name="vPrecio", type="float", precision=10, scale=0, nullable=false)
     */
    private $vprecio;

    /**
     * @var integer
     *
     * @ORM\Column(name="vCantidad", type="integer", nullable=false)
     */
    private $vcantidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="vTitulo", type="integer", nullable=false)
     */
    private $vtitulo;



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
     * Set vmonto
     *
     * @param float $vmonto
     * @return TbProducto
     */
    public function setVmonto($vmonto)
    {
        $this->vmonto = $vmonto;

        return $this;
    }

    /**
     * Get vmonto
     *
     * @return float 
     */
    public function getVmonto()
    {
        return $this->vmonto;
    }

    /**
     * Set vprecio
     *
     * @param float $vprecio
     * @return TbProducto
     */
    public function setVprecio($vprecio)
    {
        $this->vprecio = $vprecio;

        return $this;
    }

    /**
     * Get vprecio
     *
     * @return float 
     */
    public function getVprecio()
    {
        return $this->vprecio;
    }

    /**
     * Set vcantidad
     *
     * @param integer $vcantidad
     * @return TbProducto
     */
    public function setVcantidad($vcantidad)
    {
        $this->vcantidad = $vcantidad;

        return $this;
    }

    /**
     * Get vcantidad
     *
     * @return integer 
     */
    public function getVcantidad()
    {
        return $this->vcantidad;
    }

    /**
     * Set vtitulo
     *
     * @param integer $vtitulo
     * @return TbProducto
     */
    public function setVtitulo($vtitulo)
    {
        $this->vtitulo = $vtitulo;

        return $this;
    }

    /**
     * Get vtitulo
     *
     * @return integer 
     */
    public function getVtitulo()
    {
        return $this->vtitulo;
    }
}
