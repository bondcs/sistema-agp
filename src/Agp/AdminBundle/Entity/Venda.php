<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agp\AdminBundle\Entity\Venda
 *
 * @ORM\Table(name="venda")
 * @ORM\Entity
 */
class Venda
{
    /**
     * @var integer $codVenda
     *
     * @ORM\Column(name="cod_venda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $codVenda;

    /**
     * @var integer $codEmpresa
     *
     * @ORM\Column(name="cod_empresa", type="integer", nullable=false)
     */
    protected $codEmpresa;

    /**
     * @var integer $codTerminal
     *
     * @ORM\Column(name="cod_terminal", type="integer", nullable=false)
     */
    protected $codTerminal;

    /**
     * @var integer $codProduto
     *
     * @ORM\Column(name="cod_produto", type="integer", nullable=false)
     */
    protected $codProduto;

    /**
     * @var integer $codListaPreco
     *
     * @ORM\Column(name="cod_lista_preco", type="integer", nullable=false)
     */
    protected $codListaPreco;

    /**
     * @var integer $codEvento
     *
     * @ORM\Column(name="cod_evento", type="integer", nullable=false)
     */
    protected $codEvento;

    /**
     * @var integer $codAtendente
     *
     * @ORM\Column(name="cod_atendente", type="integer", nullable=false)
     */
    protected $codAtendente;

    /**
     * @var float $vlrProduto
     *
     * @ORM\Column(name="vlr_produto", type="float", nullable=false)
     */
    protected $vlrProduto;

    /**
     * @var float $qtde
     *
     * @ORM\Column(name="qtde", type="float", nullable=false)
     */
    protected $qtde;

    /**
     * @var float $subtotal
     *
     * @ORM\Column(name="subtotal", type="float", nullable=false)
     */
    protected $subtotal;

    /**
     * @var \DateTime $dtVenda
     *
     * @ORM\Column(name="dt_venda", type="datetime", nullable=false)
     */
    protected $dtVenda;

    /**
     * @var string $situacao
     *
     * @ORM\Column(name="situacao", type="string", nullable=true)
     */
    protected $situacao;



    /**
     * Get codVenda
     *
     * @return integer 
     */
    public function getCodVenda()
    {
        return $this->codVenda;
    }

    /**
     * Set codEmpresa
     *
     * @param integer $codEmpresa
     * @return Venda
     */
    public function setCodEmpresa($codEmpresa)
    {
        $this->codEmpresa = $codEmpresa;
    
        return $this;
    }

    /**
     * Get codEmpresa
     *
     * @return integer 
     */
    public function getCodEmpresa()
    {
        return $this->codEmpresa;
    }

    /**
     * Set codTerminal
     *
     * @param integer $codTerminal
     * @return Venda
     */
    public function setCodTerminal($codTerminal)
    {
        $this->codTerminal = $codTerminal;
    
        return $this;
    }

    /**
     * Get codTerminal
     *
     * @return integer 
     */
    public function getCodTerminal()
    {
        return $this->codTerminal;
    }

    /**
     * Set codProduto
     *
     * @param integer $codProduto
     * @return Venda
     */
    public function setCodProduto($codProduto)
    {
        $this->codProduto = $codProduto;
    
        return $this;
    }

    /**
     * Get codProduto
     *
     * @return integer 
     */
    public function getCodProduto()
    {
        return $this->codProduto;
    }

    /**
     * Set codListaPreco
     *
     * @param integer $codListaPreco
     * @return Venda
     */
    public function setCodListaPreco($codListaPreco)
    {
        $this->codListaPreco = $codListaPreco;
    
        return $this;
    }

    /**
     * Get codListaPreco
     *
     * @return integer 
     */
    public function getCodListaPreco()
    {
        return $this->codListaPreco;
    }

    /**
     * Set codEvento
     *
     * @param integer $codEvento
     * @return Venda
     */
    public function setCodEvento($codEvento)
    {
        $this->codEvento = $codEvento;
    
        return $this;
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
     * Set codAtendente
     *
     * @param integer $codAtendente
     * @return Venda
     */
    public function setCodAtendente($codAtendente)
    {
        $this->codAtendente = $codAtendente;
    
        return $this;
    }

    /**
     * Get codAtendente
     *
     * @return integer 
     */
    public function getCodAtendente()
    {
        return $this->codAtendente;
    }

    /**
     * Set vlrProduto
     *
     * @param float $vlrProduto
     * @return Venda
     */
    public function setVlrProduto($vlrProduto)
    {
        $this->vlrProduto = $vlrProduto;
    
        return $this;
    }

    /**
     * Get vlrProduto
     *
     * @return float 
     */
    public function getVlrProduto()
    {
        return $this->vlrProduto;
    }

    /**
     * Set qtde
     *
     * @param float $qtde
     * @return Venda
     */
    public function setQtde($qtde)
    {
        $this->qtde = $qtde;
    
        return $this;
    }

    /**
     * Get qtde
     *
     * @return float 
     */
    public function getQtde()
    {
        return $this->qtde;
    }

    /**
     * Set subtotal
     *
     * @param float $subtotal
     * @return Venda
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    
        return $this;
    }

    /**
     * Get subtotal
     *
     * @return float 
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set dtVenda
     *
     * @param \DateTime $dtVenda
     * @return Venda
     */
    public function setDtVenda($dtVenda)
    {
        $this->dtVenda = $dtVenda;
    
        return $this;
    }

    /**
     * Get dtVenda
     *
     * @return \DateTime 
     */
    public function getDtVenda()
    {
        return $this->dtVenda;
    }

    /**
     * Set situacao
     *
     * @param string $situacao
     * @return Venda
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