<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agp\AdminBundle\Entity\Cidade
 *
 * @ORM\Table(name="cidade")
 * @ORM\Entity
 */
class Cidade
{
    /**
     * @var integer $codCidade
     *
     * @ORM\Column(name="cod_cidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $codCidade;

    /**
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    protected $nome;

    /**
     * @var string $uf
     *
     * @ORM\Column(name="uf", type="string", length=2, nullable=false)
     */
    protected $uf;



    /**
     * Get codCidade
     *
     * @return integer 
     */
    public function getCodCidade()
    {
        return $this->codCidade;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Cidade
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
     * Set uf
     *
     * @param string $uf
     * @return Cidade
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    
        return $this;
    }

    /**
     * Get uf
     *
     * @return string 
     */
    public function getUf()
    {
        return $this->uf;
    }
}