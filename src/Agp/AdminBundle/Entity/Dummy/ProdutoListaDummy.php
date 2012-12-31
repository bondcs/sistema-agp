<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Entity\Dummy;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of ProdutoDummy
 *
 * @author bondcs
 */
class ProdutoListaDummy {
   
    /**
     * @Assert\Valid
     */
    public $produtoListas;
    
    public function __construct() {
        $this->produtoListas = new ArrayCollection();
    }
    
    /**
     * Get produtoListas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function setProdutoListas(ArrayCollection $produtoListas)
    {
        $this->produtoListas = $produtoListas;
    }

    /**
     * Get produtoListas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProdutoListas()
    {
        return $this->produtoListas;
    }
    
}

?>
