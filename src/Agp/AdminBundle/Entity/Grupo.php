<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Agp\AdminBundle\Entity\Grupo
 *
 * @ORM\Table(name="grupo")
 * @ORM\Entity
 */
class Grupo implements RoleInterface{
    
    /**
     * @ORM\Column(name="cod_grupo", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codGrupo;

    /**
     * @ORM\Column(name="nome", type="string", length=45)
     */
    protected $nome;

    /**
     * @ORM\Column(name="role", type="string", length=45, unique=true)
     */
    protected $role;

    /**
     * @ORM\ManyToMany(targetEntity="Pessoa", mappedBy="grupos")
     * @ORM\JoinTable(name="pessoa_grupo",
     *     joinColumns={@ORM\JoinColumn(name="cod_pessoa", referencedColumnName="cod_pessoa")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="cod_grupo", referencedColumnName="cod_grupo")}
     * )
     * @var ArrayCollection $pessoas
     */
    protected $pessoas;

    public function __construct()
    {
        $this->pessoas = new ArrayCollection();
    }

    
    /**
     * Set codGrupo
     *
     * @param integer $codGrupo
     * @return Grupo
     */
    public function setCodPessoa($codGrupo)
    {
        $this->codGrupo = $codGrupo;
        return $this;
    }
    
    
    /**
     * Get codGrupo
     *
     * @return integer 
     */
    public function getCodGrupo()
    {
        return $this->codGrupo;
    }
    
    /**
     * Set nome
     *
     * @param integer $nome
     * @return string
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
     * Get pessoas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPessoas()
    {
        return $this->pessoas;
    }

    /**
     * Add pessoa
     *
     * @param Agp\AdminBundle\Entity\Pessoa $pessoas
     */
    public function addUsuario(\Agp\AdminBundle\Entity\Pessoa $pessoa)
    {
        $this->pessoas[] = $pessoa;
    }

    /**
     * @see RoleInterface
     */
    public function getRole()
    {
        return $this->role;
    }
}

?>
