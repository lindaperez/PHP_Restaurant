<?php

namespace V\ValoraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbPaquete
 *
 * @ORM\Table(name="tb_Paquete")
 * @ORM\Entity
 */
class TbPaquete
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
     * @ORM\Column(name="vDescripcion", type="string", length=250, nullable=false)
     */
    private $vdescripcion;

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
     * Set vdescripcion
     *
     * @param string $vdescripcion
     * @return TbPaquete
     */
    public function setVdescripcion($vdescripcion)
    {
        $this->vdescripcion = $vdescripcion;

        return $this;
    }

    /**
     * Get vdescripcion
     *
     * @return string 
     */
    public function getVdescripcion()
    {
        return $this->vdescripcion;
    }

    /**
     * Set vtitulo
     *
     * @param string $vtitulo
     * @return TbPaquete
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
