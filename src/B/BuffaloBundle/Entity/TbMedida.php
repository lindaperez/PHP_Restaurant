<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbMedida
 *
 * @ORM\Table(name="tb_Medida")
 * @ORM\Entity
 */
class TbMedida
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
     * @return TbMedida
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
          //to string method   
    public function __toString()
    {
        
    return $this->getVnombre();
    
    }
    
}
