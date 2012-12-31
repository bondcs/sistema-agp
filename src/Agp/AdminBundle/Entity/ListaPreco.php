<?php

namespace Agp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Agp\AdminBundle\Entity\ListaPreco
 *
 * @ORM\Table(name="lista_preco")
 * @ORM\Entity
 */
class ListaPreco
{
    /**
     * @var object $empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_empresa", referencedColumnName="cod_empresa")
     */
    protected $empresa;

    /**
     * @var integer $codListaPreco
     *
     * @ORM\Column(name="cod_lista_preco", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $codListaPreco;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="ProdutoListaPreco", mappedBy="listaPreco", cascade={"all"})
     */
    protected $listaPrecoReference;

    /**
     * @var object $evento
     *
     * @ORM\ManyToOne(targetEntity="Evento", fetch="LAZY")
     * @ORM\JoinColumn(name="cod_evento", referencedColumnName="cod_evento", nullable=true)
     */
    protected $evento;

    /**
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=42, nullable=false)
     * @Assert\NotBlank()
     */
    protected $nome;



    /**
     * Set empresa
     *
     * @param integer $empresa
     * @return ListaPreco
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
     * Set codListaPreco
     *
     * @param integer $codListaPreco
     * @return ListaPreco
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
     * Set evento
     *
     * @param integer $evento
     * @return ListaPreco
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
    
        return $this;
    }

    /**
     * Get evento
     *
     * @return integer 
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return ListaPreco
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
     * Add $listaPrecoReference
     *
     * @param Agp\AdminBundle\Entity\ProdutoReference $listaPrecoReference
     */
    public function addListaPrecoReference(\Agp\AdminBundle\Entity\ProdutoListaPreco $listaPrecoReference)
    {
        $this->listaPrecoReference[] = $listaPrecoReference;
    }

    /**
     * Get listaPrecoReference
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getListaPrecoReference()
    {
        return $this->listaPrecoReference;
    }
}