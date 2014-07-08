<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbMesa
 *
 * @ORM\Table(name="tb_Mesa")
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
       public function __toString()
    {
        
    return strval($this->getInroMesa());
    
    }
}
