<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Agp\AdminBundle\Entity\TerminalEmpresa
 *
 * @ORM\Table(name="terminal_empresa")
 * @ORM\Entity(repositoryClass="Agp\AdminBundle\Repository\TerminalEmpresaRepository")
 */
class TerminalEmpresa
{
    
    /**
     * @var integer $codTerminalEmpresa
     *
     * @ORM\Column(name="cod_terminal_empresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codTerminalEmpresa;
    
    /** 
     * @ORM\ManyToOne(targetEntity="Terminal", inversedBy="terminalReference")
     * @ORM\JoinColumn(name="cod_terminal", referencedColumnName="cod_terminal")
     * @Assert\NotBlank(groups={"terminal"})
     * 
     */
    protected $terminal;

    /** 
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="empresaReference")
     * @ORM\JoinColumn(name="cod_empresa", referencedColumnName="cod_empresa")
     * @Assert\NotBlank(groups={"empresa"})
     * 
     */
    protected $empresa;

    
    const SIT_ATIVO = 'Ativo';
    const SIT_INATIVO = 'Inativo';
    /**
     * @var string $situacao
     *
     * @ORM\Column(name="situacao", type="string", nullable=false)
     */
    protected $situacao;

    /**
     * @var string $liberacao
     *
     * @ORM\Column(name="liberacao", type="string", length=45, nullable=true)
     */
    protected $liberacao;
    
    const BLQ_NAO = 'Não';
    const BLQ_TEMPORARIO = 'Temporario';
    const BLQ_PERMANENTE = "Permanente";
    
    /**
     * @var string $bloquear
     *
     * @ORM\Column(name="bloquear", type="string", nullable=true)
     */
    protected $bloquear;

    /**
     * @var \DateTime $dtLiberacao
     *
     * @ORM\Column(name="dt_liberacao", type="datetime", nullable=true)
     */
    protected $dtLiberacao;
    
    /**
     * @var \DateTime $dtInicio
     *
     * @ORM\Column(name="dt_inicio", type="datetime", nullable=true)
     * @Assert\NotBlank(groups={"temporario"})
     */
    protected $dtInicio;

    /**
     * @var \DateTime $dtTermino
     *
     * @ORM\Column(name="dt_termino", type="datetime", nullable=true)
     * @Assert\NotBlank(groups={"temporario"})
     */
    protected $dtTermino;
    
    const TIPO_TEMPORARIO = 'Temporario';
    const TIPO_PERMANENTE = 'Permanente';
    /**
     * @var string $situacao
     *
     * @ORM\Column(name="tipo_vinculo", type="string", nullable=false)
     */
    protected $tipoVinculo;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="HabilitaProdutoTerminal", mappedBy="terminalEmpresa", cascade={"all"})
     */
    protected $habilitaProdutoTerminalList;

    public function __construct() {
        $this->dtLiberacao = new \DateTime;
        $this->situacao = self::SIT_INATIVO;
        $this->habilitaProdutoTerminalList = new ArrayCollection;
    }
    
    public function isAtivo(){
        if ($this->situacao == self::SIT_ATIVO){
            return true;
        }else{
            return false;
        }
    }
    
    public function isPermanente(){
        if ($this->tipoVinculo == self::TIPO_PERMANENTE){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Assert\True(message = "Data de início maior que de término")
     */
    public function isDateLegal()
    {
        if ($this->dtInicio > $this->dtTermino){
            return false;
        }
        
    }
    
    static public function determineValidationGroups($form){
        $data = $form->getData();
        if ($data->getTipoVinculo() == self::TIPO_TEMPORARIO){
            return array("Default", "temporario");
        }else{
            return array("Default");
        }
        
    }

    /**
     * Get codTerminalEmpresa
     *
     * @return integer 
     */
    public function getCodTerminalEmpresa()
    {
        return $this->codTerminalEmpresa;
    }

    /**
     * Set terminal
     *
     * @param integer $terminal
     * @return TerminalEmpresa
     */
    public function setTerminal($terminal)
    {
        $this->terminal = $terminal;
    
        return $this;
    }

    /**
     * Get terminal
     *
     * @return integer 
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * Set empresa
     *
     * @param integer $empresa
     * @return TerminalEmpresa
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
     * Set situacao
     *
     * @param string $situacao
     * @return TerminalEmpresa
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    
        return $this;
    }

    /**
     * Get situacao
     *
     * @return string 
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set liberacao
     *
     * @param string $liberacao
     * @return TerminalEmpresa
     */
    public function setLiberacao($liberacao)
    {
        $this->liberacao = $liberacao;
    
        return $this;
    }

    /**
     * Get liberacao
     *
     * @return string 
     */
    public function getLiberacao()
    {
        return $this->liberacao;
    }

    /**
     * Set bloquear
     *
     * @param string $bloquear
     * @return TerminalEmpresa
     */
    public function setBloquear($bloquear)
    {
        $this->bloquear = $bloquear;
    
        return $this;
    }

    /**
     * Get bloquear
     *
     * @return string 
     */
    public function getBloquear()
    {
        return $this->bloquear;
    }

    /**
     * Set dtLiberacao
     *
     * @param \DateTime $dtLiberacao
     * @return TerminalEmpresa
     */
    public function setDtLiberacao($dtLiberacao)
    {
        $this->dtLiberacao = $dtLiberacao;
    
        return $this;
    }

    /**
     * Get dtLiberacao
     *
     * @return \DateTime 
     */
    public function getDtLiberacao()
    {
        return $this->dtLiberacao;
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
    
    /**
     * Set tipoVinculo
     *
     * @param string $tipo
     * @return TerminalEmpresa
     */
    public function setTipoVinculo($tipo)
    {
        $this->tipoVinculo = $tipo;
    
        return $this;
    }

    /**
     * Get tipoVinculo
     *
     * @return string 
     */
    public function getTipoVinculo()
    {
        return $this->tipoVinculo;
    }
    
    static public function getSituacaoList()
    {
        return array(self::SIT_ATIVO => self::SIT_ATIVO,
                     self::SIT_INATIVO => self::SIT_INATIVO
                    );
    }
    
    static public function getBloqueioList()
    {
        return array(self::BLQ_NAO => self::BLQ_NAO,
                     self::BLQ_TEMPORARIO => self::BLQ_TEMPORARIO,
                     self::BLQ_PERMANENTE => self::BLQ_PERMANENTE,
                     );
    }
    
    static public function getTipoVinculoList()
    {
        return array(self::TIPO_TEMPORARIO => self::TIPO_TEMPORARIO,
                     self::TIPO_PERMANENTE => self::TIPO_PERMANENTE
                    );
    }
    
    /**
     * Add $habilitaProdutoTerminalList
     *
     * @param Agp\AdminBundle\Entity\HabilitaListaTerminal $habilitaProdutoTerminalList
     */
    public function addHabilitaProdutoTerminalList(\Agp\AdminBundle\Entity\HabilitaProdutoTerminal $habilitaProdutoTerminalList)
    {
        $this->habilitaProdutoTerminalList[] = $habilitaProdutoTerminalList;
    }

    /**
     * Get habilitaProdutoTerminalList
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getHabilitaProdutoTerminalList()
    {
        return $this->habilitaProdutoTerminalList;
    }
    
    
}