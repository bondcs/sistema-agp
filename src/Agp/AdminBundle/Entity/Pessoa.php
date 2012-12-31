<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Agp\AdminBundle\Entity\Pessoa
 *
 * @ORM\Table(name="pessoa")
 * @ORM\Entity
 * @UniqueEntity("nome")
 * @UniqueEntity("cpf")
 */
class Pessoa implements UserInterface
{
    
    /**
     * @var integer $codPessoa
     *
     * @ORM\Column(name="cod_pessoa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codPessoa;
    
    /**
     * @var object $empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_empresa", referencedColumnName="cod_empresa")
     */
    protected $empresa;

    /**
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     * @Assert\NotBlank
     */
    protected $nome;

    /**
     * @var string $cpf
     *
     * @ORM\Column(name="cpf", type="string", length=45, nullable=false)
     * @Assert\NotBlank
     */
    protected $cpf;

    /**
     * @var string $rg
     *
     * @ORM\Column(name="rg", type="string", length=45, nullable=true)
     */
    protected $rg;

    /**
     * @var \DateTime $dtNascimento
     *
     * @ORM\Column(name="dt_nascimento", type="date", nullable=false)
     * @Assert\NotBlank
     */
    protected $dtNascimento;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=60, nullable=true)
     * @Assert\NotBlank
     */
    protected $email;

    /**
     * @var string $senha
     *
     * @ORM\Column(name="senha", type="string", length=32, nullable=true)
     * @Assert\NotBlank
     */
    protected $senha;
    
    /**
     * @ORM\ManyToMany(targetEntity="Grupo", inversedBy="pessoas")
     * @ORM\JoinTable(name="pessoa_grupo",
     *     joinColumns={@ORM\JoinColumn(name="cod_pessoa", referencedColumnName="cod_pessoa")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="cod_grupo", referencedColumnName="cod_grupo")}
     * )
     * 
     * @var ArrayCollection $grupos
     * @Assert\NotBlank
     */
    protected $grupos;

    public function __construct() {
        $this->grupos = new ArrayCollection();
    }
    
    /* Métodos para manipulação de login */
    
    public function eraseCredentials(){}
    
    /**
     * Get password
     */
    public function getPassword() {
        return $this->getSenha();
    }
    
    /**
     * Get Salt para criptografia
     */
    public function getSalt() {
        return null;
    }
    
    /*
     * get username/email
     */
    public function getUsername() {
        return $this->email;
    }
    
    /**
     * return array de roles
     */
    public function getRoles() {
        return $this->getGrupos()->toArray();;
    }
    
    /**
     * Set empresa
     *
     * @param object $empresa
     * @return Empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get e
     *
     * @return object 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set codPessoa
     *
     * @param integer $codPessoa
     * @return Pessoa
     */
    public function setCodPessoa($codPessoa)
    {
        $this->codPessoa = $codPessoa;
        return $this;
    }

    /**
     * Get codPessoa
     *
     * @return integer 
     */
    public function getCodPessoa()
    {
        return $this->codPessoa;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Pessoa
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
     * Set cpf
     *
     * @param string $cpf
     * @return Pessoa
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    
        return $this;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set rg
     *
     * @param string $rg
     * @return Pessoa
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    
        return $this;
    }

    /**
     * Get rg
     *
     * @return string 
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set dtNascimento
     *
     * @param \DateTime $dtNascimento
     * @return Pessoa
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
    
        return $this;
    }

    /**
     * Get dtNascimento
     *
     * @return \DateTime 
     */
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Pessoa
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set senha
     *
     * @param string $senha
     * @return Pessoa
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    
        return $this;
    }

    /**
     * Get senha
     *
     * @return string 
     */
    public function getSenha()
    {
        return $this->senha;
    }
    
    /**
     * Add grupos
     *
     * @param Agp\AdminBundle\Entity\Grupo $grupos
     */
    public function addRole(\Agp\AdminBundle\Entity\Grupo $grupo)
    {
        $this->grupos[] = $grupo;
    }
    
    /**
     * Set the grupos.
     * 
     */
    public function setGrupos($grupos)
    {
        $this->grupos = $grupos;
    }
    
    /**
     * Gets the grupos.
     *
     * @return ArrayCollection A Doctrine ArrayCollection
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

}