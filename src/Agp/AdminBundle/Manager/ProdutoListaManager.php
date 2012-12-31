<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Doctrine\ORM\EntityManager;
use Agp\AdminBundle\Entity\ProdutoListaPreco;
/**
 * Description of ProdutoListaManager
 *
 * @author bondcs
 */
class ProdutoListaManager {
    
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
    
    public function createProdutoLista()
    {
        $class = $this->class;
        $produtoListaPreco = new $class();
        
        return $produtoListaPreco;
    }

    public function save(ProdutoListaPreco $produtoListaPreco, $listaId = null)
    {
        if ($listaId != null) {
            $listaPreco = $this->em->find("AgpAdminBundle:ListaPreco", $listaId);
            $produtoListaPreco->setListaPreco($listaPreco);
        }
        
        $produtoListaPreco->setEmpresa($this->context->getToken()->getUser()->getEmpresa());
        if ($produtoListaPreco->getCodProdutoListaPreco()){
            $this->em->merge($produtoListaPreco);
        }else{
            $this->em->persist($produtoListaPreco);
        }
        $this->em->flush();
        
    }
    
    public function deleteProdutoLista(ProdutoListaPreco $produtoListaPreco)
    {
        $this->em->remove($produtoListaPreco);
        $this->em->flush();
        
    }

}

?>
