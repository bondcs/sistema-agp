<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Doctrine\ORM\EntityManager;
use Agp\AdminBundle\Entity\Produto;
/**
 * Description of ProdutoManager
 *
 * @author bondcs
 */
class ProdutoManager {
    
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
    
    public function createProduto()
    {
        $class = $this->class;
        $produto = new $class();
        
        return $produto;
    }

    public function saveProduto(Produto $produto)
    {
        $produto->setEmpresa($this->context->getToken()->getUser()->getEmpresa());
        if ($produto->getCodProduto()){
            $this->em->merge($produto);
        }else{
            $this->em->persist($produto);
        }
        $this->em->flush();
        
    }
    
    public function deleteProduto(Produto $produto)
    {
        $this->em->remove($produto);
        $this->em->flush();
        
    }

}

?>
