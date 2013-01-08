<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Form\Handler;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Agp\AdminBundle\Manager\EntradaProdutoManager;
use Agp\AdminBundle\Entity\EntradaProduto;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of EntradaProdutoHandler
 *
 * @author bondcs
 */
class EntradaProdutoHandler {
    
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
        $this->manager = $container->get("agp.entradaProduto.manager");
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
            $entity->setProduto($this->options['produto']);
            $entity->atualizaProdutoEstoque($this->options['qtdeOld']);
            $this->manager->persist($entity);
        } 
            
        if($this->estrategia == self::UPDATE){
            $entity->atualizaProdutoEstoque($this->options['qtdeOld']);
            $this->manager->update($entity);
        }

    }
    
    public function getForm()
    {
        if (!$this->form){
            $entradaProdutoType = $this->container->get("agp.entradaProduto.form.type");
            $entradaProdutoType->setOptions($this->options);
            
            if($this->estrategia == self::INSERT){
                $this->form = $this->factory->create($entradaProdutoType);
                $this->setOptions(array('qtdeOld' => 0));
            } 
            
            if($this->estrategia == self::UPDATE){
                $this->form = $this->factory->create($entradaProdutoType, $this->options["entity"]);
                $this->setOptions(array('qtdeOld' => $this->options['entity']->getQtde()));
            }
            
            if ($this->request->getMethod() == "POST"){
                $this->form->bind($this->request);
            }
        }
        
        return $this->form;
    }
}

?>
