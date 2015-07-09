<?php

namespace V\ValoraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbServicio
 *
 * @ORM\Table(name="tb_Servicio", uniqueConstraints={@ORM\UniqueConstraint(name="tb_Estado_Servicio", columns={"dEstatus_Servicio"}), @ORM\UniqueConstraint(name="fk_Paquete", columns={"fk_Paquete"})}, indexes={@ORM\Index(name="tb_Cliente", columns={"tb_Cliente"})})
 * @ORM\Entity
 */
class TbServicio
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
     * @var \DateTime
     *
     * @ORM\Column(name="dFecha_Solicitud", type="date", nullable=false)
     */
    private $dfechaSolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dFecha_Cierre", type="date", nullable=false)
     */
    private $dfechaCierre;

    /**
     * @var \V\ValoraBundle\Entity\TbEdoServicio
     *
     * @ORM\ManyToOne(targetEntity="V\ValoraBundle\Entity\TbEdoServicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dEstatus_Servicio", referencedColumnName="id")
     * })
     */
    private $destatusServicio;

    /**
     * @var \V\ValoraBundle\Entity\TbRelPaqueteProducto
     *
     * @ORM\ManyToOne(targetEntity="V\ValoraBundle\Entity\TbRelPaqueteProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Paquete", referencedColumnName="id")
     * })
     */
    private $fkPaquete;

    /**
     * @var \V\ValoraBundle\Entity\TbPersona
     *
     * @ORM\ManyToOne(targetEntity="V\ValoraBundle\Entity\TbPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_Cliente", referencedColumnName="id")
     * })
     */
    private $tbCliente;



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
     * Set dfechaSolicitud
     *
     * @param \DateTime $dfechaSolicitud
     * @return TbServicio
     */
    public function setDfechaSolicitud($dfechaSolicitud)
    {
        $this->dfechaSolicitud = $dfechaSolicitud;

        return $this;
    }

    /**
     * Get dfechaSolicitud
     *
     * @return \DateTime 
     */
    public function getDfechaSolicitud()
    {
        return $this->dfechaSolicitud;
    }

    /**
     * Set dfechaCierre
     *
     * @param \DateTime $dfechaCierre
     * @return TbServicio
     */
    public function setDfechaCierre($dfechaCierre)
    {
        $this->dfechaCierre = $dfechaCierre;

        return $this;
    }

    /**
     * Get dfechaCierre
     *
     * @return \DateTime 
     */
    public function getDfechaCierre()
    {
        return $this->dfechaCierre;
    }

    /**
     * Set destatusServicio
     *
     * @param \V\ValoraBundle\Entity\TbEdoServicio $destatusServicio
     * @return TbServicio
     */
    public function setDestatusServicio(\V\ValoraBundle\Entity\TbEdoServicio $destatusServicio = null)
    {
        $this->destatusServicio = $destatusServicio;

        return $this;
    }

    /**
     * Get destatusServicio
     *
     * @return \V\ValoraBundle\Entity\TbEdoServicio 
     */
    public function getDestatusServicio()
    {
        return $this->destatusServicio;
    }

    /**
     * Set fkPaquete
     *
     * @param \V\ValoraBundle\Entity\TbRelPaqueteProducto $fkPaquete
     * @return TbServicio
     */
    public function setFkPaquete(\V\ValoraBundle\Entity\TbRelPaqueteProducto $fkPaquete = null)
    {
        $this->fkPaquete = $fkPaquete;

        return $this;
    }

    /**
     * Get fkPaquete
     *
     * @return \V\ValoraBundle\Entity\TbRelPaqueteProducto 
     */
    public function getFkPaquete()
    {
        return $this->fkPaquete;
    }

    /**
     * Set tbCliente
     *
     * @param \V\ValoraBundle\Entity\TbPersona $tbCliente
     * @return TbServicio
     */
    public function setTbCliente(\V\ValoraBundle\Entity\TbPersona $tbCliente = null)
    {
        $this->tbCliente = $tbCliente;

        return $this;
    }

    /**
     * Get tbCliente
     *
     * @return \V\ValoraBundle\Entity\TbPersona 
     */
    public function getTbCliente()
    {
        return $this->tbCliente;
    }
}
