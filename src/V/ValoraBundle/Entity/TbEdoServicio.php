<?php

namespace V\ValoraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbEdoServicio
 *
 * @ORM\Table(name="tb_Edo_Servicio")
 * @ORM\Entity
 */
class TbEdoServicio
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
     * @ORM\Column(name="vEstatus", type="string", length=150, nullable=false)
     */
    private $vestatus;



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
     * Set vestatus
     *
     * @param string $vestatus
     * @return TbEdoServicio
     */
    public function setVestatus($vestatus)
    {
        $this->vestatus = $vestatus;

        return $this;
    }

    /**
     * Get vestatus
     *
     * @return string 
     */
    public function getVestatus()
    {
        return $this->vestatus;
    }
}
