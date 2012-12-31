<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\Handler;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Agp\AdminBundle\Manager\EventoManager;
use Agp\AdminBundle\Entity\Evento;

/**
 * Description of EventoHandler
 *
 * @author bondcs
 */
class EventoHandler {
    
    protected $form;
    protected $manager;
    protected $request;


    public function __construct(Form $form, EventoManager $manager, Request $request) {
        $this->form = $form;
        $this->manager = $manager;
        $this->request = $request;
    }
    
    public function process($Evento = null){
        
        $Evento = $Evento == null ? $this->manager->createEvento() : $Evento;
        $this->form->setData($Evento);
        
        if ($this->request->getMethod() == "POST"){
            $this->form->bind($this->request);
            if($this->form->isValid()){
                $this->onSuccess($Evento);
                return true;
            }
        }
        
        return false;
        
    }
    
    public function onSuccess(Evento $Evento){
        $this->manager->saveEvento($Evento);
    }
}

?>
