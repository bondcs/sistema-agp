<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\Handler;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Agp\AdminBundle\Manager\ProdutoListaManager;
use Agp\AdminBundle\Entity\ProdutoListaPreco;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of ProdutoListaHandler
 *
 * @author bondcs
 */
class ProdutoListaHandler {
    
    protected $factory;
    protected $container;
    protected $manager; 
    protected $request;
    protected $form;
    protected $options;
    
    protected $estrategia;
    const INSERT = 0;
    const UPDATE = 1;

    public function __construct(FormFactory $factory, ContainerInterface $container) 
    {
        $this->factory = $factory;
        $this->container = $container;
        $this->manager = $container->get("agp.produtoLista.manager");
        $this->request = $container->get("request");
        $this->options = array();
        $this->estrategia = self::INSERT;
        
    }
    
    public function useInsertEstrategia()
    {
        $this->estrategia = self::INSERT;
    }

    public function useUpdateEstrategia()
    {
        $this->estrategia = self::UPDATE;
    }
    
    public function setOptions($options){
        $this->options = array_merge($this->options, $options);
    }

    public function process()
    {
        $this->getForm();
        if ($this->request->getMethod() == "POST"){
            $formData = $this->form->getData();
            if($this->form->isValid()){
                $this->onSuccess($formData);
                return true;
            }
        }
        
        return false;
        
    }
    
    public function onSuccess($entity){
        
        if($this->estrategia == self::INSERT){
            $this->manager->save($entity, $this->options["lista"]);
        } 
            
        if($this->estrategia == self::UPDATE){
            $this->manager->save($entity);
        }
    }
    
    public function getForm()
    {
        if (!$this->form){
            $produtoListaType = $this->container->get("agp.produtoLista.form.type");
            $produtoListaType->setOptions($this->options);
            
            if($this->estrategia == self::INSERT){
                $this->form = $this->factory->create($produtoListaType);
            } 
            
            if($this->estrategia == self::UPDATE){
                $this->form = $this->factory->create($produtoListaType, $this->options["entity"]);
            }
            
            if ($this->request->getMethod() == "POST"){
                $this->form->bind($this->request);
            }
        }
        
        return $this->form;
    }
}

?>
