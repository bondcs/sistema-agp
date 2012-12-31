<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agp\AdminBundle\Entity\HabilitaProdutoTerminal
 *
 * @ORM\Table(name="habilita_produto_terminal")
 * @ORM\Entity(repositoryClass="Agp\AdminBundle\Repository\HabilitaProdutoTerminalRepository")
 */
class HabilitaProdutoTerminal
{
    /**
     * @var integer $codHabilitaProdutoTerminal
     *
     * @ORM\Column(name="cod_habilita_produto_terminal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codHabilitaProdutoTerminal;
    
    /**
     * @var object $produtoListaPreco
     *
     * @ORM\ManyToOne(targetEntity="ProdutoListaPreco", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_produto_lista_preco", referencedColumnName="cod_produto_lista_preco")
     */
    protected $produtoListaPreco;
    
    /**
     * @var object $terminalEmpresa
     *
     * @ORM\ManyToOne(targetEntity="TerminalEmpresa", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_terminal_empresa", referencedColumnName="cod_terminal_empresa")
     */
    protected $terminalEmpresa;

    /**
     * @var object $evento
     *
     * @ORM\ManyToOne(targetEntity="Evento", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_evento", referencedColumnName="cod_evento", nullable=true)
     */
    protected $evento;
    
    const SIT_ATIVO = 'Ativo';
    const SIT_INATIVO = 'Inativo';
    /**
     * @var string $situacao
     *
     * @ORM\Column(name="situacao", type="string", nullable=false)
     */
    protected $situacao;
    
    public function __construct() {
        $this->situacao = self::SIT_ATIVO;
    }
    
    public function isAtivo(){
        if($this->situacao == self::SIT_ATIVO){
           return true;
        }else{
           $this->situacao == self::SIT_INATIVO;
           return false;
        }
    }

    public function getCodHabilitaProdutoTerminal(){
        return $this->codHabilitaProdutoTerminal;
    }

    /**
     * Set terminalEmpresa
     *
     * @param integer $terminalEmpresa
     * @return HabilitaProdutoTerminal
     */
    public function setTerminalEmpresa($terminalEmpresa)
    {
        $this->terminalEmpresa = $terminalEmpresa;
    
        return $this;
    }

    /**
     * Get terminalEmpresa
     *
     * @return integer 
     */
    public function getTerminalEmpresa()
    {
        return $this->terminalEmpresa;
    }
    
    /**
     * Set produtoListaPreco
     *
     * @param integer $produtoListaPreco
     * @return HabilitaProdutoTerminal
     */
    public function setProdutoListaPreco($produtoListaPreco)
    {
        $this->produtoListaPreco = $produtoListaPreco;
    
        return $this;
    }

    /**
     * Get produtoListaPreco
     *
     * @return integer 
     */
    public function getProdutoListaPreco()
    {
        return $this->produtoListaPreco;
    }

   
    /**
     * Set evento
     *
     * @param integer $evento
     * @return HabilitaProdutoTerminal
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
    
        return $this;
    }

    /**
     * Get evento
     *
     * @return integer 
     */
    public function getEvento()
    {
        return $this->evento;
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
}