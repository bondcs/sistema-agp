<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Agp\AdminBundle\Entity\Atendente
 *
 * @ORM\Table(name="atendente")
 * @ORM\Entity
 */
class Atendente
{
    /**
     * @var integer $codAtendente
     *
     * @ORM\Column(name="cod_atendente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codAtendente;

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
     * @ORM\Column(name="nome", type="string", length=42, nullable=false)
     * @Assert\NotBlank()
     */
    protected $nome;

    /**
     * @var string $senha
     *
     * @ORM\Column(name="senha", type="string", length=6, nullable=true)
     * @Assert\MaxLength(6)
     */
    protected $senha;



    /**
     * Set codAtendente
     *
     * @param integer $codAtendente
     * @return Atendente
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
     * Set empresa
     *
     * @param integer $empresa
     * @return Atendente
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
     * Set nome
     *
     * @param string $nome
     * @return Atendente
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
     * Set senha
     *
     * @param string $senha
     * @return Atendente
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
}