<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Doctrine\ORM\EntityManager;
use Agp\AdminBundle\Entity\ListaPreco;
/**
 * Description of ListaManager
 *
 * @author bondcs
 */
class ListaManager {
    
    protected $em;
    protected $class;
    protected $repository;
    protected $context;


    public function __construct(EntityManager $em, $class, $context) {
        $this->em = $em;
        $this->class = $class;
        $this->repository = $em->getRepository($class);
        $this->context = $context;
    }
    
    public function findAll()
    {
        return $this->repository->findAll();
    }
    
    public function findById($id)
    {
        return $this->repository->find($id);
    }
    
    public function findByEmpresa($empresa)
    {
        return $this->repository->findBy(array("empresa" => $empresa));
    }
    
    public function createLista()
    {
        $class = $this->class;
        $lista = new $class();
        
        return $lista;
    }

    public function saveLista(ListaPreco $lista)
    {
        $lista->setEmpresa($this->context->getToken()->getUser()->getEmpresa());
        $this->em->persist($lista);
        $this->em->flush();
        
    }
    
    public function deleteLista(ListaPreco $lista)
    {
        $this->em->remove($lista);
        $this->em->flush();
        
    }

}

?>
