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
     * @ORM\Column(name="vCantidad_Uso", type="integer", nullable=false)
     */
    private $vcantidadUso;

    /**
     * @var string
     *
     * @ORM\Column(name="vTitulo", type="string", length=150, nullable=false)
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
     * Set vcantidadUso
     *
     * @param integer $vcantidadUso
     * @return TbProducto
     */
    public function setVcantidadUso($vcantidadUso)
    {
        $this->vcantidadUso = $vcantidadUso;

        return $this;
    }

    /**
     * Get vcantidadUso
     *
     * @return integer 
     */
    public function getVcantidadUso()
    {
        return $this->vcantidadUso;
    }

    /**
     * Set vtitulo
     *
     * @param string $vtitulo
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
     * @return string 
     */
    public function getVtitulo()
    {
        return $this->vtitulo;
    }
    public function __toString() {
        return $this->getVtitulo();
}
    
    }
