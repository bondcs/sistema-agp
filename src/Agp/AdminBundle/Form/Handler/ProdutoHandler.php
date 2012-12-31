<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\Handler;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Agp\AdminBundle\Manager\ProdutoManager;
use Agp\AdminBundle\Entity\Produto;

/**
 * Description of ProdutoHandler
 *
 * @author bondcs
 */
class ProdutoHandler {
    
    protected $form;
    protected $manager;
    protected $request;


    public function __construct(Form $form, ProdutoManager $manager, Request $request) {
        $this->form = $form;
        $this->manager = $manager;
        $this->request = $request;
    }
    
    public function process($produto = null){
        
        $produto = $produto == null ? $this->manager->createProduto() : $produto;
        $this->form->setData($produto);
        
        if ($this->request->getMethod() == "POST"){
            $this->form->bind($this->request);
            if($this->form->isValid()){
                $this->onSuccess($produto);
                return true;
            }
        }
        
        return false;
        
    }
    
    public function onSuccess(Produto $produto){
        $this->manager->saveProduto($produto);
    }
}

?>
