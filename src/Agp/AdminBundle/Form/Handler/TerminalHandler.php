<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\Handler;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Agp\AdminBundle\Manager\TerminalManager;
use Agp\AdminBundle\Entity\Terminal;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of TerminalHandler
 *
 * @author bondcs
 */
class TerminalHandler {
    
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
        $this->manager = $container->get("agp.terminal.manager");
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
            $this->manager->persist($entity);
        } 
            
        if($this->estrategia == self::UPDATE){
            $this->manager->update($entity);
        }
    }
    
    public function getForm()
    {
        if (!$this->form){
            $terminalType = $this->container->get("agp.terminal.form.type");
            $terminalType->setOptions($this->options);
            
            if($this->estrategia == self::INSERT){
                $this->form = $this->factory->create($terminalType);
            } 
            
            if($this->estrategia == self::UPDATE){
                $this->form = $this->factory->create($terminalType, $this->options["entity"]);
            }
            
            if ($this->request->getMethod() == "POST"){
                $this->form->bind($this->request);
            }
        }
        
        return $this->form;
    }
}

?>
