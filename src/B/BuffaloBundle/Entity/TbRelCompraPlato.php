<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbRelCompraPlato
 *
 * @ORM\Table(name="tb_Rel_Compra_Plato", indexes={@ORM\Index(name="iID_CPLATO", columns={"fk_iID_CPLATO"}), @ORM\Index(name="iID_COMPRA", columns={"fk_iID_COMPRA"})})
 * @ORM\Entity
 */
class TbRelCompraPlato
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
     * @var \B\BuffaloBundle\Entity\TbPlato
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbPlato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_CPLATO", referencedColumnName="id")
     * })
     */
    private $fkIidCplato;

    /**
     * @var \B\BuffaloBundle\Entity\TbCompra
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbCompra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_COMPRA", referencedColumnName="id")
     * })
     */
    private $fkIidCompra;



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
     * Set fkIidCplato
     *
     * @param \B\BuffaloBundle\Entity\TbPlato $fkIidCplato
     * @return TbRelCompraPlato
     */
    public function setFkIidCplato(\B\BuffaloBundle\Entity\TbPlato $fkIidCplato = null)
    {
        $this->fkIidCplato = $fkIidCplato;

        return $this;
    }

    /**
     * Get fkIidCplato
     *
     * @return \B\BuffaloBundle\Entity\TbPlato 
     */
    public function getFkIidCplato()
    {
        return $this->fkIidCplato;
    }

    /**
     * Set fkIidCompra
     *
     * @param \B\BuffaloBundle\Entity\TbCompra $fkIidCompra
     * @return TbRelCompraPlato
     */
    public function setFkIidCompra(\B\BuffaloBundle\Entity\TbCompra $fkIidCompra = null)
    {
        $this->fkIidCompra = $fkIidCompra;

        return $this;
    }

    /**
     * Get fkIidCompra
     *
     * @return \B\BuffaloBundle\Entity\TbCompra 
     */
    public function getFkIidCompra()
    {
        return $this->fkIidCompra;
    }
}
