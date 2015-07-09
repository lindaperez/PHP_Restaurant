<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbRelPlatoIngrediente
 *
 * @ORM\Table(name="tb_Rel_Plato_Ingrediente", indexes={@ORM\Index(name="iID_INGREDIENTES", columns={"fk_iID_INGREDIENTE"}), @ORM\Index(name="iID_PLATO", columns={"fk_iID_PLATO"}), @ORM\Index(name="iID_MEDIDA", columns={"fk_iID_MEDIDA"})})
 * @ORM\Entity
 */
class TbRelPlatoIngrediente
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
     * @ORM\Column(name="dCANTIDAD", type="float", precision=10, scale=0, nullable=false)
     */
    private $dcantidad;

    /**
     * @var \B\BuffaloBundle\Entity\TbIngrediente
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbIngrediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_INGREDIENTE", referencedColumnName="id")
     * })
     */
    private $fkIidIngrediente;

    /**
     * @var \B\BuffaloBundle\Entity\TbPlato
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbPlato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_PLATO", referencedColumnName="id")
     * })
     */
    private $fkIidPlato;

    /**
     * @var \B\BuffaloBundle\Entity\TbMedida
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbMedida")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_MEDIDA", referencedColumnName="id")
     * })
     */
    private $fkIidMedida;



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
     * Set dcantidad
     *
     * @param float $dcantidad
     * @return TbRelPlatoIngrediente
     */
    public function setDcantidad($dcantidad)
    {
        $this->dcantidad = $dcantidad;

        return $this;
    }

    /**
     * Get dcantidad
     *
     * @return float 
     */
    public function getDcantidad()
    {
        return $this->dcantidad;
    }

    /**
     * Set fkIidIngrediente
     *
     * @param \B\BuffaloBundle\Entity\TbIngrediente $fkIidIngrediente
     * @return TbRelPlatoIngrediente
     */
    public function setFkIidIngrediente(\B\BuffaloBundle\Entity\TbIngrediente $fkIidIngrediente = null)
    {
        $this->fkIidIngrediente = $fkIidIngrediente;

        return $this;
    }

    /**
     * Get fkIidIngrediente
     *
     * @return \B\BuffaloBundle\Entity\TbIngrediente 
     */
    public function getFkIidIngrediente()
    {
        return $this->fkIidIngrediente;
    }

    /**
     * Set fkIidPlato
     *
     * @param \B\BuffaloBundle\Entity\TbPlato $fkIidPlato
     * @return TbRelPlatoIngrediente
     */
    public function setFkIidPlato(\B\BuffaloBundle\Entity\TbPlato $fkIidPlato = null)
    {
        $this->fkIidPlato = $fkIidPlato;

        return $this;
    }

    /**
     * Get fkIidPlato
     *
     * @return \B\BuffaloBundle\Entity\TbPlato 
     */
    public function getFkIidPlato()
    {
        return $this->fkIidPlato;
    }

    /**
     * Set fkIidMedida
     *
     * @param \B\BuffaloBundle\Entity\TbMedida $fkIidMedida
     * @return TbRelPlatoIngrediente
     */
    public function setFkIidMedida(\B\BuffaloBundle\Entity\TbMedida $fkIidMedida = null)
    {
        $this->fkIidMedida = $fkIidMedida;

        return $this;
    }

    /**
     * Get fkIidMedida
     *
     * @return \B\BuffaloBundle\Entity\TbMedida 
     */
    public function getFkIidMedida()
    {
        return $this->fkIidMedida;
    }
}
