<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\Handler;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Agp\AdminBundle\Manager\ListaManager;
use Agp\AdminBundle\Entity\ListaPreco;

/**
 * Description of ListaHandler
 *
 * @author bondcs
 */
class ListaHandler {
    
    protected $form;
    protected $manager;
    protected $request;


    public function __construct(Form $form, ListaManager $manager, Request $request) {
        $this->form = $form;
        $this->manager = $manager;
        $this->request = $request;
    }
    
    public function process($lista = null){
        
        $lista = $lista == null ? $this->manager->createLista() : $lista;
        $this->form->setData($lista);
        
        if ($this->request->getMethod() == "POST"){
            $this->form->bind($this->request);
            if($this->form->isValid()){
                $this->onSuccess($lista);
                return true;
            }
        }
        
        return false;
        
    }
    
    public function onSuccess(ListaPreco $lista){
        $this->manager->saveLista($lista);
    }
}

?>
