<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Agp\AdminBundle\Manager\BaseManager;
/**
 * Description of EntradaProdutoManager
 *
 * @author bondcs
 */
class EntradaProdutoManager extends BaseManager{
    
    public function remove($entity)
    {
        $produto = $entity->getProduto();
        $produto->retirarQtde($entity->getQtde());
        
        $this->update($produto);
        $this->em->remove($entity);
        $this->em->flush();
        
    }
        
}

?>
