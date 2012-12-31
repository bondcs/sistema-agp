<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\Handler;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Agp\AdminBundle\Manager\AtendenteManager;
use Agp\AdminBundle\Entity\Atendente;

/**
 * Description of AtendenteHandler
 *
 * @author bondcs
 */
class AtendenteHandler {
    
    protected $form;
    protected $manager;
    protected $request;


    public function __construct(Form $form, AtendenteManager $manager, Request $request) {
        $this->form = $form;
        $this->manager = $manager;
        $this->request = $request;
    }
    
    public function process($atendente = null){
        
        $atendente = $atendente == null ? $this->manager->createAtendente() : $atendente;
        $this->form->setData($atendente);
        
        if ($this->request->getMethod() == "POST"){
            $this->form->bind($this->request);
            if($this->form->isValid()){
                $this->onSuccess($atendente);
                return true;
            }
        }
        
        return false;
        
    }
    
    public function onSuccess(Atendente $atendente){
        $this->manager->saveAtendente($atendente);
    }
}

?>
