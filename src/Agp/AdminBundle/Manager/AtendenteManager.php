<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Manager;

use Doctrine\ORM\EntityManager;
use Agp\AdminBundle\Entity\Atendente;
/**
 * Description of AtendenteManager
 *
 * @author bondcs
 */
class AtendenteManager {
    
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
    
    public function createAtendente()
    {
        $class = $this->class;
        $atendente = new $class();
        
        return $atendente;
    }

    public function saveAtendente(Atendente $atendente)
    {
        $atendente->setEmpresa($this->context->getToken()->getUser()->getEmpresa());
        $this->em->persist($atendente);
        $this->em->flush();
        
    }
    
    public function deleteAtendente(Atendente $atendente)
    {
        $this->em->remove($atendente);
        $this->em->flush();
        
    }

}

?>
