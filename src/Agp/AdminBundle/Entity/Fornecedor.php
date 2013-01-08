<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Agp\AdminBundle\Entity\Fornecedor
 *
 * @ORM\Table(name="fornecedor")
 * @ORM\Entity
 */
class Fornecedor
{
    /**
     * @var integer $codFornecedor
     *
     * @ORM\Column(name="cod_fornecedor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codFornecedor;
    
    /**
     * @var string $razaoSocial
     *
     * @ORM\Column(name="razao_social", type="string", length=45, nullable=false)
     * @Assert\NotBlank
     */
    protected $razaoSocial;
    
    /**
     * @var string $fantasia
     *
     * @ORM\Column(name="fantasia", type="string", length=45, nullable=true)
     */
    protected $fantasia;
    
    /**
     * @var string $telefone
     *
     * @ORM\Column(name="telefone", type="string", length=45, nullable=true)
     */
    protected $telefone;
    
    /**
     * @var object $empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_empresa", referencedColumnName="cod_empresa")
     */
    protected $empresa;
    
    /**
     * Get codFornecedor
     *
     * @return integer 
     */
    public function getCodFornecedor()
    {
        return $this->codFornecedor;
    }
    
    /**
     * Set razaoSocial
     *
     * @param string $razaoSocial
     * @return Empresa
     */
    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
    
        return $this;
    }

    /**
     * Get razaoSocial
     *
     * @return string 
     */
    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    /**
     * Set fantasia
     *
     * @param string $fantasia
     * @return Empresa
     */
    public function setFantasia($fantasia)
    {
        $this->fantasia = $fantasia;
    
        return $this;
    }

    /**
     * Get fantasia
     *
     * @return string 
     */
    public function getFantasia()
    {
        return $this->fantasia;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     * @return Empresa
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    
        return $this;
    }

    /**
     * Get telefone
     *
     * @return string 
     */
    public function getTelefone()
    {
        return $this->telefone;
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

}