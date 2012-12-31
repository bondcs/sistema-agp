<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Doctrine\ORM\EntityManager;
use Agp\AdminBundle\Entity\TerminalEmpresa;
use Agp\AdminBundle\Entity\Terminal;
use Agp\AdminBundle\Manager\BaseManager;
/**
 * Description of TerminalEmpresaManager
 *
 * @author bondcs
 */
class TerminalEmpresaManager extends BaseManager{
    
    public function updateSituacao($entity)
    {
        
        $terminal = $entity->getTerminal();
        if ($entity->isAtivo()){
            $entity->setSituacao(TerminalEmpresa::SIT_INATIVO);
            $terminal->setSituacao(Terminal::SIT_DISPONIVEL);
        }else{
            if ($terminal->getTerminalVinculoAtivo()){
                return false;
            }
            
            $entity->setSituacao(TerminalEmpresa::SIT_ATIVO);
            
            if($entity->isPermanente()){
               $terminal->setSituacao(Terminal::SIT_VENDIDO);
            }else{
               $terminal->setSituacao(Terminal::SIT_ALUGADO); 
            }
        }
        
        $this->update($entity);
        return true;
    }
}

?>
