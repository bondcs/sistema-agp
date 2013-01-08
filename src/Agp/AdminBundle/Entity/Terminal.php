<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Agp\AdminBundle\Entity\Terminal
 *
 * @ORM\Table(name="terminal")
 * @ORM\Entity
 */
class Terminal
{
    /**
     * @var integer $codTerminal
     *
     * @ORM\Column(name="cod_terminal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codTerminal;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="TerminalEmpresa", mappedBy="terminal", cascade={"all"})
     */
    protected $terminalReference;

    /**
     * @var string $noSerie
     *
     * @ORM\Column(name="no_serie", type="string", length=11, nullable=false)
     * @Assert\NotBlank
     */
    protected $noSerie;

    
    const FRABRICANTE_VERIFONE = "Verifone";
    /**
     * @var string $fabricante
     *
     * @ORM\Column(name="fabricante", type="string", nullable=true)
     * @Assert\NotBlank
     */
    protected $fabricante;

    const VERSAO_VX520 = "VX520";
    const VERSAO_VX680 = "VX680";
    /**
     * @var string $versao
     *
     * @ORM\Column(name="versao", type="string", nullable=true)
     * @Assert\NotBlank
     */
    protected $versao;

    /**
     * @var \DateTime $dtEntrada
     *
     * @ORM\Column(name="dt_entrada", type="date", nullable=false)
     * @Assert\NotBlank
     */
    protected $dtEntrada;

    const SIT_DISPONIVEL = "Disponível";
    const SIT_MANUTENCAO = "Manutenção";
    const SIT_ALUGADO = "Alugado";
    const SIT_VENDIDO = "Vendido";
    /**
     * @var string $situacao
     *
     * @ORM\Column(name="situacao", type="string", nullable=true)
     * @Assert\NotBlank
     */
    protected $situacao;

    public function __construct() {
        $this->terminalReference = new ArrayCollection();
        $this->dtEntrada = new \DateTime;
    }

    /**
     * Get codTerminal
     *
     * @return integer 
     */
    public function getCodTerminal()
    {
        return str_pad($this->codTerminal, 4, "0", STR_PAD_LEFT);
    }

    /**
     * Set noSerie
     *
     * @param string $noSerie
     * @return Terminal
     */
    public function setNoSerie($noSerie)
    {
        $this->noSerie = $noSerie;
    
        return $this;
    }

    /**
     * Get noSerie
     *
     * @return string 
     */
    public function getNoSerie()
    {
        return $this->noSerie;
    }

    /**
     * Set fabricante
     *
     * @param string $fabricante
     * @return Terminal
     */
    public function setFabricante($fabricante)
    {
        $this->fabricante = $fabricante;
    
        return $this;
    }

    /**
     * Get fabricante
     *
     * @return string 
     */
    public function getFabricante()
    {
        return $this->fabricante;
    }

    /**
     * Set versao
     *
     * @param string $versao
     * @return Terminal
     */
    public function setVersao($versao)
    {
        $this->versao = $versao;
    
        return $this;
    }

    /**
     * Get versao
     *
     * @return string 
     */
    public function getVersao()
    {
        return $this->versao;
    }

    /**
     * Set dtEntrada
     *
     * @param \DateTime $dtEntrada
     * @return Terminal
     */
    public function setDtEntrada($dtEntrada)
    {
        $this->dtEntrada = $dtEntrada;
    
        return $this;
    }

    /**
     * Get dtEntrada
     *
     * @return \DateTime 
     */
    public function getDtEntrada()
    {
        return $this->dtEntrada;
    }

    /**
     * Set situacao
     *
     * @param string $situacao
     * @return Terminal
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
     * Add $terminalReference
     *
     * @param Agp\AdminBundle\Entity\TerminalReference $terminalReference
     */
    public function addTerminalReference(\Agp\AdminBundle\Entity\TerminalEmpresa $terminalReference)
    {
        $this->terminalReference[] = $terminalReference;
    }

    /**
     * Get terminalReference
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTerminalReference()
    {
        return $this->terminalReference;
    }
    
    static public function getFrabricanteList()
    {
        return array(self::FRABRICANTE_VERIFONE => self::FRABRICANTE_VERIFONE);
    }
    
    static public function getVersaoList()
    {
        return array(self::VERSAO_VX520 => self::VERSAO_VX520,
                     self::VERSAO_VX680 => self::VERSAO_VX680);
    }
    
    static public function getSituacaoList()
    {
        return array(self::SIT_DISPONIVEL => self::SIT_DISPONIVEL,
                     self::SIT_MANUTENCAO => self::SIT_MANUTENCAO,
                     self::SIT_ALUGADO => self::SIT_ALUGADO,
                     self::SIT_VENDIDO => self::SIT_VENDIDO);
    }
    
    public function getTerminalVinculoAtivo(){
        foreach ($this->getTerminalReference() as $terminalReference){
            if ($terminalReference->isAtivo()){
                return $terminalReference;
            }
        }
    }
}