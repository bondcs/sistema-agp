<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Doctrine\ORM\EntityManager;
use Agp\AdminBundle\Entity\Evento;
/**
 * Description of EventoManager
 *
 * @author bondcs
 */
class EventoManager {
    
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
    
    public function createEvento()
    {
        $class = $this->class;
        $evento = new $class();
        
        return $evento;
    }

    public function saveEvento(Evento $evento)
    {
        $evento->setEmpresa($this->context->getToken()->getUser()->getEmpresa());
        $this->em->persist($evento);
        $this->em->flush();
        
    }
    
    public function deleteEvento(Evento $evento)
    {
        $this->em->remove($evento);
        $this->em->flush();
        
    }

}

?>
