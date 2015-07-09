<?php

namespace V\ValoraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbPersona
 *
 * @ORM\Table(name="tb_Persona", indexes={@ORM\Index(name="fk_TipoPersona", columns={"fk_TipoPersona"})})
 * @ORM\Entity
 */
class TbPersona
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
     * @ORM\Column(name="vRuc", type="string", length=150, nullable=false)
     */
    private $vruc;

    /**
     * @var string
     *
     * @ORM\Column(name="vNombre", type="string", length=150, nullable=false)
     */
    private $vnombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="vApellido", type="integer", nullable=false)
     */
    private $vapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="iCorreo", type="string", length=250, nullable=false)
     */
    private $icorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="vClave", type="string", length=128, nullable=false)
     */
    private $vclave;

    /**
     * @var \V\ValoraBundle\Entity\TbTipoPersona
     *
     * @ORM\ManyToOne(targetEntity="V\ValoraBundle\Entity\TbTipoPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_TipoPersona", referencedColumnName="id")
     * })
     */
    private $fkTipopersona;



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
     * Set vruc
     *
     * @param string $vruc
     * @return TbPersona
     */
    public function setVruc($vruc)
    {
        $this->vruc = $vruc;

        return $this;
    }

    /**
     * Get vruc
     *
     * @return string 
     */
    public function getVruc()
    {
        return $this->vruc;
    }

    /**
     * Set vnombre
     *
     * @param string $vnombre
     * @return TbPersona
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

    /**
     * Set vapellido
     *
     * @param integer $vapellido
     * @return TbPersona
     */
    public function setVapellido($vapellido)
    {
        $this->vapellido = $vapellido;

        return $this;
    }

    /**
     * Get vapellido
     *
     * @return integer 
     */
    public function getVapellido()
    {
        return $this->vapellido;
    }

    /**
     * Set icorreo
     *
     * @param string $icorreo
     * @return TbPersona
     */
    public function setIcorreo($icorreo)
    {
        $this->icorreo = $icorreo;

        return $this;
    }

    /**
     * Get icorreo
     *
     * @return string 
     */
    public function getIcorreo()
    {
        return $this->icorreo;
    }

    /**
     * Set vclave
     *
     * @param string $vclave
     * @return TbPersona
     */
    public function setVclave($vclave)
    {
        $this->vclave = $vclave;

        return $this;
    }

    /**
     * Get vclave
     *
     * @return string 
     */
    public function getVclave()
    {
        return $this->vclave;
    }

    /**
     * Set fkTipopersona
     *
     * @param \V\ValoraBundle\Entity\TbTipoPersona $fkTipopersona
     * @return TbPersona
     */
    public function setFkTipopersona(\V\ValoraBundle\Entity\TbTipoPersona $fkTipopersona = null)
    {
        $this->fkTipopersona = $fkTipopersona;

        return $this;
    }

    /**
     * Get fkTipopersona
     *
     * @return \V\ValoraBundle\Entity\TbTipoPersona 
     */
    public function getFkTipopersona()
    {
        return $this->fkTipopersona;
    }
}
