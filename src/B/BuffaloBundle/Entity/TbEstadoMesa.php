<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbEstadoMesa
 *
 * @ORM\Table(name="tb_ESTADO_MESA")
 * @ORM\Entity
 */
class TbEstadoMesa
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
     * @ORM\Column(name="vDESCRIPCION", type="string", length=45, nullable=false)
     */
    private $vdescripcion;



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
     * @return TbEstadoMesa
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
    public function __toString()
    {
        
    return $this->getVdescripcion();
    
}
}
