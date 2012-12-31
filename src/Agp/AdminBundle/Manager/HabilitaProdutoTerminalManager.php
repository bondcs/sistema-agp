<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Doctrine\ORM\EntityManager;
use Agp\AdminBundle\Entity\Terminal;
use Agp\AdminBundle\Manager\BaseManager;
use Agp\AdminBundle\Entity\HabilitaProdutoTerminal;
/**
 * Description of HabilitaProdutoTerminalManager
 *
 * @author bondcs
 */
class HabilitaProdutoTerminalManager extends BaseManager{
    
    public function habilitaProdutoTerminal($lista, $terminalManager)
    {   
        $this->repository->clearProdutosHabilitados($terminalManager);
        foreach ($lista->getListaPrecoReference() as $listaPrecoReference){
            $habilita = $this->create();
            $habilita->setTerminalEmpresa($terminalManager)
                     ->setProdutoListaPreco($listaPrecoReference)
                     ->setEvento($lista->getEvento());
            $this->persist($habilita);
        }

    }
    
    public function changeSituacao($entity){
        
        if ($entity->isAtivo()){
            $entity->setSituacao(HabilitaProdutoTerminal::SIT_INATIVO);
        }else{
            $entity->setSituacao(HabilitaProdutoTerminal::SIT_ATIVO);
        }
        
        $this->update($entity);
        
    }
  
}

?>
