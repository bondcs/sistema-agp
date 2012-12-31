<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\Container;
/**
 * Description of BaseManager
 *
 * @author bondcs
 */
class BaseManager {
    
    protected $em;
    protected $class;
    protected $repository;
    protected $container;


    public function __construct(Container $container, $class) {
        $this->em = $container->get("doctrine")->getEntityManager();
        $this->class = $class;
        $this->repository = $this->em->getRepository($class);
        $this->container = $container;
    }
    
    public function findAll()
    {
        return $this->repository->findAll();
    }
    
    public function findById($id)
    {
        return $this->repository->find($id);
    }
    
    public function create()
    {
        $class = $this->class;
        $entity = new $class();
        
        return $entity;
    }

    public function persist($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
        
    }
    
    public function update($entity)
    {
        $this->em->merge($entity);
        $this->em->flush();
        
    }

    public function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
        
    }
    
    public function flush(){
        $this->em->flush();
    }
    
    public function refresh($entity){
        $this->em->refresh($entity);
    }
}

?>
