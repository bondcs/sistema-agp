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
class ProdutoDummy {
   
    /**
     * @Assert\Valid
     */
    public $produtos;
    
    public function __construct() {
        $this->produtos = new ArrayCollection();
    }
    
    /**
     * Get produtos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function setProdutos(ArrayCollection $produtos)
    {
        $this->produtos = $produtos;
    }

    /**
     * Get produtos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProdutos()
    {
        return $this->produtos;
    }
    
}

?>
