<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Agp\AdminBundle\Entity\Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity
 */
class Empresa
{
    /**
     * @var integer $codEmpresa
     *
     * @ORM\Column(name="cod_empresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codEmpresa;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="TerminalEmpresa", mappedBy="empresa", cascade={"all"})
     */
    protected $empresaReference;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="ListaPreco", mappedBy="empresa", cascade={"all"})
     */
    protected $listas;
    
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
     * @var string $cnpj
     *
     * @ORM\Column(name="cnpj", type="string", length=45, nullable=false)
     * @Assert\NotBlank
     */
    protected $cnpj;

    /**
     * @var string $ie
     *
     * @ORM\Column(name="ie", type="string", length=45, nullable=true)
     */
    protected $ie;

    /**
     * @var string $im
     *
     * @ORM\Column(name="im", type="string", length=45, nullable=true)
     */
    protected $im;

    /**
     * @var string $endereco
     *
     * @ORM\Column(name="endereco", type="string", length=45, nullable=false)
     * @Assert\NotBlank
     */
    protected $endereco;

    /**
     * @var string $complemento
     *
     * @ORM\Column(name="complemento", type="string", length=45, nullable=true)
     */
    protected $complemento;

    /**
     * @var string $cep
     *
     * @ORM\Column(name="cep", type="string", length=45, nullable=false)
     * @Assert\NotBlank
     */
    protected $cep;

    /**
     * @var string $bairro
     *
     * @ORM\Column(name="bairro", type="string", length=45, nullable=false)
     * @Assert\NotBlank
     */
    protected $bairro;

    /**
     * @var integer $cidade
     *
     * @ORM\ManyToOne(targetEntity="Cidade", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="cod_cidade", referencedColumnName="cod_cidade")
     * @Assert\NotBlank
     */
    protected $cidade;

    /**
     * @var integer $codPessoaMaster
     *
     * @ORM\Column(name="cod_pessoa_master", type="integer", nullable=true)
     */
    protected $codPessoaMaster;

    public function __construct() {
        $this->empresaReference = new ArrayCollection();
        $this->listas = new ArrayCollection();
    }
    
    public function getTerminais(){
        $terminas = array();
        foreach ($this->getEmpresaReference() as $empresaReference){
            $terminas[] = $empresaReference->getTerminal();
        } 
        
        return $terminas;
    }
    
    public function getTerminaisAtivos(){
        $terminas = array();
        foreach ($this->getEmpresaReference() as $empresaReference){
            if ($empresaReference->isAtivo()){
                $terminas[] = $empresaReference;
            }
        } 
        
        return $terminas;
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
     * Set cnpj
     *
     * @param string $cnpj
     * @return Empresa
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    
        return $this;
    }

    /**
     * Get cnpj
     *
     * @return string 
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set ie
     *
     * @param string $ie
     * @return Empresa
     */
    public function setIe($ie)
    {
        $this->ie = $ie;
    
        return $this;
    }

    /**
     * Get ie
     *
     * @return string 
     */
    public function getIe()
    {
        return $this->ie;
    }

    /**
     * Set im
     *
     * @param string $im
     * @return Empresa
     */
    public function setIm($im)
    {
        $this->im = $im;
    
        return $this;
    }

    /**
     * Get im
     *
     * @return string 
     */
    public function getIm()
    {
        return $this->im;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     * @return Empresa
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    
        return $this;
    }

    /**
     * Get endereco
     *
     * @return string 
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set complemento
     *
     * @param string $complemento
     * @return Empresa
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    
        return $this;
    }

    /**
     * Get complemento
     *
     * @return string 
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set cep
     *
     * @param string $cep
     * @return Empresa
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    
        return $this;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     * @return Empresa
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    
        return $this;
    }

    /**
     * Get bairro
     *
     * @return string 
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set cidade
     *
     * @param integer $cidade
     * @return Empresa
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    
        return $this;
    }

    /**
     * Get cidade
     *
     * @return integer 
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set codPessoaMaster
     *
     * @param integer $codPessoaMaster
     * @return Empresa
     */
    public function setCodPessoaMaster($codPessoaMaster)
    {
        $this->codPessoaMaster = $codPessoaMaster;
    
        return $this;
    }

    /**
     * Get codPessoaMaster
     *
     * @return integer 
     */
    public function getCodPessoaMaster()
    {
        return $this->codPessoaMaster;
    }
    
    /**
     * Add $empresaReference
     *
     * @param Agp\AdminBundle\Entity\TerminalEmpresa $empresaReference
     */
    public function addEmpresaReference(\Agp\AdminBundle\Entity\TerminalEmpresa $empresaReference)
    {
        $this->empresaReference[] = $empresaReference;
    }

    /**
     * Get empresaReference
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEmpresaReference()
    {
        return $this->empresaReference;
    }
    
    /**
     * Add $lista
     *
     * @param Agp\AdminBundle\Entity\TerminalEmpresa $lista
     */
    public function addListas(\Agp\AdminBundle\Entity\ListaPreco $lista)
    {
        $this->listas[] = $lista;
    }

    /**
     * Get lista
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getListas()
    {
        return $this->listas;
    }
}