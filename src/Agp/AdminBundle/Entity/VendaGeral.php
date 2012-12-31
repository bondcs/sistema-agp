<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agp\AdminBundle\Entity\VendaGeral
 *
 * @ORM\Table(name="venda_geral")
 * @ORM\Entity(repositoryClass="Agp\AdminBundle\Repository\VendaGeralRepository")
 */
class VendaGeral
{
    /**
     * @var integer $codVendaGeral
     *
     * @ORM\Column(name="cod_venda_geral", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $codVendaGeral;

    /**
     * @var integer $codTerminal
     *
     * @ORM\ManyToOne(targetEntity="Terminal", cascade={"all"}, fetch="LAZY")
     * @ORM\JoinColumn(name="cod_terminal", referencedColumnName="cod_terminal")
     */
    protected $terminal;

    /**
     * @var integer $codEmpresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", cascade={"all"}, fetch="LAZY")
     * @ORM\JoinColumn(name="cod_empresa", referencedColumnName="cod_empresa")
     */
    protected $empresa;

    /**
     * @var integer $numFechamento
     *
     * @ORM\Column(name="num_fechamento", type="integer", nullable=false)
     */
    protected $numFechamento;

    /**
     * @var string $nomeProduto
     *
     * @ORM\Column(name="nome_produto", type="string", length=42, nullable=false)
     */
    protected $nomeProduto;

    /**
     * @var float $qtdeTotal
     *
     * @ORM\Column(name="qtde_total", type="float", nullable=true)
     */
    protected $qtdeTotal;

    /**
     * @var float $vlrTotal
     *
     * @ORM\Column(name="vlr_total", type="float", nullable=true)
     */
    protected $vlrTotal;

    /**
     * @var \DateTime $dtUltimaAtualizacao
     *
     * @ORM\Column(name="dt_ultima_atualizacao", type="datetime", nullable=true)
     */
    protected $dtUltimaAtualizacao;



    /**
     * Get codVendaGeral
     *
     * @return integer 
     */
    public function getCodVendaGeral()
    {
        return $this->codVendaGeral;
    }

    /**
     * Set codTerminal
     *
     * @param integer $terminal
     * @return VendaGeral
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
     * @return VendaGeral
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
     * Set numFechamento
     *
     * @param integer $numFechamento
     * @return VendaGeral
     */
    public function setNumFechamento($numFechamento)
    {
        $this->numFechamento = $numFechamento;
    
        return $this;
    }

    /**
     * Get numFechamento
     *
     * @return integer 
     */
    public function getNumFechamento()
    {
        return $this->numFechamento;
    }

    /**
     * Set nomeProduto
     *
     * @param string $nomeProduto
     * @return VendaGeral
     */
    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;
    
        return $this;
    }

    /**
     * Get nomeProduto
     *
     * @return string 
     */
    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    /**
     * Set qtdeTotal
     *
     * @param float $qtdeTotal
     * @return VendaGeral
     */
    public function setQtdeTotal($qtdeTotal)
    {
        $this->qtdeTotal = $qtdeTotal;
    
        return $this;
    }

    /**
     * Get qtdeTotal
     *
     * @return float 
     */
    public function getQtdeTotal()
    {
        return $this->qtdeTotal;
    }

    /**
     * Set vlrTotal
     *
     * @param float $vlrTotal
     * @return VendaGeral
     */
    public function setVlrTotal($vlrTotal)
    {
        $this->vlrTotal = $vlrTotal;
    
        return $this;
    }

    /**
     * Get vlrTotal
     *
     * @return float 
     */
    public function getVlrTotal()
    {
        return $this->vlrTotal;
    }

    /**
     * Set dtUltimaAtualizacao
     *
     * @param \DateTime $dtUltimaAtualizacao
     * @return VendaGeral
     */
    public function setDtUltimaAtualizacao($dtUltimaAtualizacao)
    {
        $this->dtUltimaAtualizacao = $dtUltimaAtualizacao;
    
        return $this;
    }

    /**
     * Get dtUltimaAtualizacao
     *
     * @return \DateTime 
     */
    public function getDtUltimaAtualizacao()
    {
        return $this->dtUltimaAtualizacao;
    }
}