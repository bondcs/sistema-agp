<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Agp\AdminBundle\Entity\EntradaProduto
 *
 * @ORM\Table(name="entrada_produto")
 * @ORM\Entity(repositoryClass="Agp\AdminBundle\Repository\EntradaProdutoRepository")
 */
class EntradaProduto
{
    
    /**
     * @var integer $codEntradaProduto
     *
     * @ORM\Column(name="cod_entrada_produto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codEntradaProduto;
     
    /**
     * @var float $vlrCusto
     *
     * @ORM\Column(name="vlr_custo", type="float", nullable=true)
     * @Assert\NotBlank
     */
    protected $vlrCusto;

    /**
     * @var float $qtde
     *
     * @ORM\Column(name="qtde", type="float", nullable=true)
     * @Assert\NotBlank
     */
    protected $qtde;
    
    /**
     * @var \DateTime $dtEntrada
     *
     * @ORM\Column(name="dt_entrada", type="datetime", nullable=true)
     */
    protected $dtEntrada;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Produto", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="cod_produto", referencedColumnName="cod_produto")
     */
    protected $produto;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Fornecedor", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="cod_fornecedor", referencedColumnName="cod_fornecedor")
     * @Assert\NotBlank
     */
    protected $fornecedor;

    public function __construct() {
        $this->dtEntrada = new \DateTime;
    }
    
    public function atualizaProdutoEstoque($qtdeOld){
        $diff = $this->getQtde() - $qtdeOld;
        $this->getProduto()->atualizaQtde($diff);
    }
    
    public function getCustoTotal(){
        return $this->vlrCusto * $this->qtde;
    }

    /**
     * Set codEntradaProduto
     *
     * @param integer $codEntradaProduto
     * @return EntradaProduto
     */
    public function setCodEntradaProduto($codEntradaProduto)
    {
        $this->codEntradaProduto = $codEntradaProduto;
    
        return $this;
    }

    /**
     * Get codEntradaProduto
     *
     * @return integer 
     */
    public function getCodEntradaProduto()
    {
        return $this->codEntradaProduto;
    }

    /**
     * Set vlrCusto
     *
     * @param float $vlrCusto
     * @return EntradaProduto
     */
    public function setVlrCusto($vlrCusto)
    {
        $this->vlrCusto = substr(str_replace(",", ".", $vlrCusto),3);
        return $this;
    }

    /**
     * Get vlrCusto
     *
     * @return float 
     */
    public function getVlrCusto()
    {
        return $this->vlrCusto;
    }

    /**
     * Set qtde
     *
     * @param int $qtde
     * @return EntradaProduto
     */
    public function setQtde($qtde)
    {
        $this->qtde = $qtde;
    
        return $this;
    }

    /**
     * Get qtde
     *
     * @return int 
     */
    public function getQtde()
    {
        return $this->qtde;
    }

    /**
     * Set dtEntrada
     *
     * @param float $dtEntrada
     * @return EntradaProduto
     */
    public function setDtEntrada($dtEntrada)
    {
        $this->dtEntrada = $dtEntrada;
    
        return $this;
    }

    /**
     * Get dtEntrada
     *
     * @return float 
     */
    public function getDtEntrada()
    {
        return $this->dtEntrada;
    }
    
    /**
     * Set fornecedor
     *
     * @param string $fornecedor
     * @return EntradaProduto
     */
    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;
    
        return $this;
    }

    /**
     * Get fornecedor
     *
     * @return string 
     */
    public function getFornecedor()
    {
        return $this->fornecedor;
    }
    
     /**
     * Set produto
     *
     * @param string $produto
     * @return Produto
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;
    
        return $this;
    }

    /**
     * Get produto
     *
     * @return string 
     */
    public function getProduto()
    {
        return $this->produto;
    }
     
}