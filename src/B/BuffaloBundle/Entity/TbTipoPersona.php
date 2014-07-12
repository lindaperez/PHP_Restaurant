<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbTipoPersona
 *
 * @ORM\Table(name="tb_Tipo_Persona")
 * @ORM\Entity
 */
class TbTipoPersona
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
     * @ORM\Column(name="vTITULO", type="string", length=45, nullable=false)
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
     * Set vtitulo
     *
     * @param string $vtitulo
     * @return TbTipoPersona
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
          //to string method   
    public function __toString()
    {
        
    return $this->getVtitulo();
    
}
}
