<?php

namespace B\BuffaloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * TbPersona
 *
 * @ORM\Table(name="tb_Persona", indexes={@ORM\Index(name="fk_tb_Persona", columns={"fk_iID_Tipo_Persona"}), @ORM\Index(name="fk_tb_Persona_1", columns={"fk_iID_ESTADO_PERSONA"})})
 * @ORM\Entity
 */
class TbPersona implements UserInterface
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
     * @ORM\Column(name="iCEDULA", type="integer", nullable=false)
     */
    private $icedula;

    /**
     * @var string
     *
     * @ORM\Column(name="vNOMBRE", type="string", length=45, nullable=false)
     */
    private $vnombre;

    /**
     * @var string
     *
     * @ORM\Column(name="vAPELLIDO", type="string", length=45, nullable=false)
     */
    private $vapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="vCORREO", type="string", length=45, nullable=false)
     */
    private $vcorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="iTELEFONO", type="string", length=45, nullable=false)
     */
    private $itelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="vDIRECCION", type="string", length=45, nullable=false)
     */
    private $vdireccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="iCLAVE", type="integer", nullable=false)
     */
    private $iclave;

    /**
     * @var \B\BuffaloBundle\Entity\TbTipoPersona
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbTipoPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_Tipo_Persona", referencedColumnName="id")
     * })
     */
    private $fkIidTipoPersona;

    /**
     * @var \B\BuffaloBundle\Entity\TbEstadoPersona
     *
     * @ORM\ManyToOne(targetEntity="B\BuffaloBundle\Entity\TbEstadoPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_iID_ESTADO_PERSONA", referencedColumnName="id")
     * })
     */
    private $fkIidEstadoPersona;



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
     * Set icedula
     *
     * @param integer $icedula
     * @return TbPersona
     */
    public function setIcedula($icedula)
    {
        $this->icedula = $icedula;

        return $this;
    }

    /**
     * Get icedula
     *
     * @return integer 
     */
    public function getIcedula()
    {
        return $this->icedula;
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
     * @param string $vapellido
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
     * @return string 
     */
    public function getVapellido()
    {
        return $this->vapellido;
    }

    /**
     * Set vcorreo
     *
     * @param string $vcorreo
     * @return TbPersona
     */
    public function setVcorreo($vcorreo)
    {
        $this->vcorreo = $vcorreo;

        return $this;
    }

    /**
     * Get vcorreo
     *
     * @return string 
     */
    public function getVcorreo()
    {
        return $this->vcorreo;
    }

    /**
     * Set itelefono
     *
     * @param string $itelefono
     * @return TbPersona
     */
    public function setItelefono($itelefono)
    {
        $this->itelefono = $itelefono;

        return $this;
    }

    /**
     * Get itelefono
     *
     * @return string 
     */
    public function getItelefono()
    {
        return $this->itelefono;
    }

    /**
     * Set vdireccion
     *
     * @param string $vdireccion
     * @return TbPersona
     */
    public function setVdireccion($vdireccion)
    {
        $this->vdireccion = $vdireccion;

        return $this;
    }

    /**
     * Get vdireccion
     *
     * @return string 
     */
    public function getVdireccion()
    {
        return $this->vdireccion;
    }

    /**
     * Set iclave
     *
     * @param integer $iclave
     * @return TbPersona
     */
    public function setIclave($iclave)
    {
        $this->iclave = $iclave;

        return $this;
    }

    /**
     * Get iclave
     *
     * @return integer 
     */
    public function getIclave()
    {
        return $this->iclave;
    }

    /**
     * Set fkIidTipoPersona
     *
     * @param \B\BuffaloBundle\Entity\TbTipoPersona $fkIidTipoPersona
     * @return TbPersona
     */
    public function setFkIidTipoPersona(\B\BuffaloBundle\Entity\TbTipoPersona $fkIidTipoPersona = null)
    {
        $this->fkIidTipoPersona = $fkIidTipoPersona;

        return $this;
    }

    /**
     * Get fkIidTipoPersona
     *
     * @return \B\BuffaloBundle\Entity\TbTipoPersona 
     */
    public function getFkIidTipoPersona()
    {
        return $this->fkIidTipoPersona;
    }

    /**
     * Set fkIidEstadoPersona
     *
     * @param \B\BuffaloBundle\Entity\TbEstadoPersona $fkIidEstadoPersona
     * @return TbPersona
     */
    public function setFkIidEstadoPersona(\B\BuffaloBundle\Entity\TbEstadoPersona $fkIidEstadoPersona = null)
    {
        $this->fkIidEstadoPersona = $fkIidEstadoPersona;

        return $this;
    }

    /**
     * Get fkIidEstadoPersona
     *
     * @return \B\BuffaloBundle\Entity\TbEstadoPersona 
     */
    public function getFkIidEstadoPersona()
    {
        return $this->fkIidEstadoPersona;
    }
         public function __toString()
    {
        
    return $this->getVnombre()." ".$this->getVapellido();
    
    } 
    //Para implementar los metodos de UserInterfaces

//Returns the roles granted to the user. 
//Corregir
 public function getRoles()
    {
	//Corregir
        return array('ROLE_USER');
}
 //Returns the salt that was originally used to encode the password.
    public function getSalt()
    {
        return null;
    }
 //Removes sensitive data from the user.

    public function eraseCredentials()
    {
        
    }
//Returns whether or not the given user is equivalent to this user.
    public function equals(UserInterface $user)
    {
        return $user->getUsername() == $this->icedula;
    }
//Usuario Corregir
    public function getUsername()
    {
	//Corregir
        return $this->icedula;    
    }
        public function setUsername($username)
    {
	//Corregir
        $this->icedula=(int)$username;    
    }
    //Contrasena
    public function getPassword()   
    {
	//Corregir
        return $this->iclave;
    }
    public function setPassword($iclave)   
    {
	//Corregir
        $this->iclave=$iclave;
    }
    

}
