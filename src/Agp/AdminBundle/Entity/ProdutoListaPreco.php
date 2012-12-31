<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Agp\AdminBundle\Entity\ProdutoListaPreco
 *
 * @ORM\Table(name="produto_lista_preco")
 * @ORM\Entity
 */
class ProdutoListaPreco
{
    /**
     * @var object $empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_empresa", referencedColumnName="cod_empresa")
     */
    protected $empresa;
    
    /** 
     * @ORM\ManyToOne(targetEntity="Produto", inversedBy="produtoReference")
     * @ORM\JoinColumn(name="cod_produto", referencedColumnName="cod_produto")
     * @Assert\NotBlank
     * 
     */
    protected $produto;

    /** 
     * @ORM\ManyToOne(targetEntity="ListaPreco", inversedBy="listaPrecoReference")
     * @ORM\JoinColumn(name="cod_lista_preco", referencedColumnName="cod_lista_preco")
     * 
     */
    protected $listaPreco;
    
    /**
     * @var integer $codProdutoListaPreco
     *
     * @ORM\Column(name="cod_produto_lista_preco", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codProdutoListaPreco;

    /**
     * @var float $vlrProduto
     *
     * @ORM\Column(name="vlr_produto", type="float", nullable=false)
     * @Assert\NotBlank
     */
    protected $vlrProduto;

    /**
     * @var integer $limiteVendas
     *
     * @ORM\Column(name="limite_vendas", type="integer", nullable=true)
     */
    protected $limiteVendas;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="HabilitaProdutoTerminal", mappedBy="produtoListaPreco", cascade={"all"})
     */
    protected $habilitaProdutoTerminalList;
    
    public function __construct() {
        $this->habilitaProdutoTerminalList= new ArrayCollection;
        $this->limiteVendas = 0;
    }

        /**
     * Get codProdutoListaPreco
     *
     * @return integer 
     */
    public function getCodProdutoListaPreco()
    {
        return $this->codProdutoListaPreco;
    }
    
    /**
     * Set codProdutoListaPreco
     * 
     */
    public function setCodProdutoListaPreco($id)
    {
        $this->codProdutoListaPreco = $id;
    }

    /**
     * Set empresa
     *
     * @param integer $empresa
     * @return ProdutoListaPreco
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
     * Set produto
     *
     * @param integer $produto
     * @return ProdutoListaPreco
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;
    
        return $this;
    }

    /**
     * Get produto
     *
     * @return integer 
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set listaPreco
     *
     * @param integer $listaPreco
     * @return listaPreco
     */
    public function setListaPreco($listaPreco)
    {
        $this->listaPreco = $listaPreco;
    
        return $this;
    }

    /**
     * Get listaPreco
     *
     * @return integer 
     */
    public function getListaPreco()
    {
        return $this->listaPreco;
    }

    /**
     * Set vlrProduto
     *
     * @param float $vlrProduto
     * @return ProdutoListaPreco
     */
    public function setVlrProduto($vlrProduto)
    {
        $this->vlrProduto = substr(str_replace(",", ".", $vlrProduto),3);
    
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
     * Set limiteVendas
     *
     * @param integer $limiteVendas
     * @return ProdutoListaPreco
     */
    public function setLimiteVendas($limiteVendas)
    {
        $this->limiteVendas = $limiteVendas;
    
        return $this;
    }

    /**
     * Get limiteVendas
     *
     * @return integer 
     */
    public function getLimiteVendas()
    {
        return $this->limiteVendas;
    }
    
    /**
     * Add $habilitaProdutoTerminalList
     *
     * @param Agp\AdminBundle\Entity\HabilitaProdutoTerminal $habilitaProdutoTerminalList
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