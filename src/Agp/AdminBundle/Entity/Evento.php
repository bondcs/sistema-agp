<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Agp\AdminBundle\Entity\Evento
 *
 * @ORM\Table(name="evento")
 * @ORM\Entity
 */
class Evento
{
    /**
     * @var integer $codEvento
     *
     * @ORM\Column(name="cod_evento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $codEvento;

    /**
     * @var object $empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_empresa", referencedColumnName="cod_empresa")
     */
    protected $empresa;

    /**
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     * @Assert\NotBlank
     */
    protected $nome;

    /**
     * @var \DateTime $dtInicio
     *
     * @ORM\Column(name="dt_inicio", type="date", nullable=true)
     */
    protected $dtInicio;

    /**
     * @var \DateTime $dtTermino
     *
     * @ORM\Column(name="dt_termino", type="date", nullable=true)
     */
    protected $dtTermino;

    /**
     * @Assert\True(message = "Data de início maior que de término")
     */
    public function isDateLegal()
    {
        if ($this->dtInicio > $this->dtTermino){
            return false;
        }
        
    }

    /**
     * Get codEvento
     *
     * @return integer 
     */
    public function getCodEvento()
    {
        return $this->codEvento;
    }

    /**
     * Set empresa
     *
     * @param integer $empresa
     * @return Atendente
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return integer 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Evento
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set dtInicio
     *
     * @param \DateTime $dtInicio
     * @return Evento
     */
    public function setDtInicio($dtInicio)
    {
        $this->dtInicio = $dtInicio;
    
        return $this;
    }

    /**
     * Get dtInicio
     *
     * @return \DateTime 
     */
    public function getDtInicio()
    {
        return $this->dtInicio;
    }

    /**
     * Set dtTermino
     *
     * @param \DateTime $dtTermino
     * @return Evento
     */
    public function setDtTermino($dtTermino)
    {
        $this->dtTermino = $dtTermino;
    
        return $this;
    }

    /**
     * Get dtTermino
     *
     * @return \DateTime 
     */
    public function getDtTermino()
    {
        return $this->dtTermino;
    }
}