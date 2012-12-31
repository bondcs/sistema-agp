<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Agp\AdminBundle\Entity\Produto
 *
 * @ORM\Table(name="produto")
 * @ORM\Entity
 */
class Produto
{
    
    /**
     * @var integer $codProduto
     *
     * @ORM\Column(name="cod_produto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codProduto;
    
    /**
     * @var object $empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_empresa", referencedColumnName="cod_empresa")
     */
    protected $empresa;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="ProdutoListaPreco", mappedBy="produto", cascade={"all"})
     */
    protected $produtoReference;

    /**
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=42, nullable=false)
     * @Assert\NotBlank
     */
    protected $nome;

    /**
     * @var float $vlrBase
     *
     * @ORM\Column(name="vlr_base", type="float", nullable=true)
     * @Assert\NotBlank
     */
    protected $vlrBase;

    /**
     * @var float $qtdeMinimo
     *
     * @ORM\Column(name="qtde_minimo", type="float", nullable=true)
     */
    protected $qtdeMinimo;

    /**
     * @var float $qtdeAtual
     *
     * @ORM\Column(name="qtde_atual", type="float", nullable=true)
     */
    protected $qtdeAtual;

    public function __construct() {
        $this->ProdutoList = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->nome;
    }

    /**
     * Set empresa
     *
     * @param integer $empresa
     * @return Produto
     */
    public function setEmpresa(Empresa $empresa)
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
     * Set codProduto
     *
     * @param integer $codProduto
     * @return Produto
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
     * Set nome
     *
     * @param string $nome
     * @return Produto
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
     * Set vlrBase
     *
     * @param float $vlrBase
     * @return Produto
     */
    public function setVlrBase($vlrBase)
    {
        $this->vlrBase = substr(str_replace(",", ".", $vlrBase),3);
    
        return $this;
    }

    /**
     * Get vlrBase
     *
     * @return float 
     */
    public function getVlrBase()
    {
        return $this->vlrBase;
    }

    /**
     * Set qtdeMinimo
     *
     * @param float $qtdeMinimo
     * @return Produto
     */
    public function setQtdeMinimo($qtdeMinimo)
    {
        $this->qtdeMinimo = $qtdeMinimo;
    
        return $this;
    }

    /**
     * Get qtdeMinimo
     *
     * @return float 
     */
    public function getQtdeMinimo()
    {
        return $this->qtdeMinimo;
    }

    /**
     * Set qtdeAtual
     *
     * @param float $qtdeAtual
     * @return Produto
     */
    public function setQtdeAtual($qtdeAtual)
    {
        $this->qtdeAtual = $qtdeAtual;
    
        return $this;
    }

    /**
     * Get qtdeAtual
     *
     * @return float 
     */
    public function getQtdeAtual()
    {
        return $this->qtdeAtual;
    }
    
    /**
     * Add $produtoReference
     *
     * @param Agp\AdminBundle\Entity\ProdutoReference $produtoReference
     */
    public function addProdutoReference(\Agp\AdminBundle\Entity\Produto $produtoReference)
    {
        $this->produtoReference[] = $produtoReference;
    }

    /**
     * Get produtoReference
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProdutoReference()
    {
        return $this->produtoReference;
    }
    
}