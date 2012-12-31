<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Agp\AdminBundle\Form\FormFilter\HabilitaProdutoType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of HabilitaProdutoTerminalController
 *
 * @author bondcs
 * @Route("/usuario/terminal/habilita-produto-terminal")
 */
class HabilitaProdutoTerminalController extends Controller{
    
    /**
     * @Route("/{id}", name="habilitaProdutoTerminalIndex", options={"expose" = true})
     * @Template("")
     */
    public function indexAction($id)
    {    
        $form = $this->createForm(new HabilitaProdutoType($this->getUser()));
        $entity = $this->get("agp.terminalEmpresa.manager")->findById($id); 
        
        return array("form" => $form->createView(),
                     "entity" => $entity);
    }
  
    
    /**
     * @Route("/gera-produto-vinculado/{lista}/{terminalEmpresa}", name="geraProdutoVinculado", options={"expose" = true})
     * @Template("")
     */
    public function addAction($lista, $terminalEmpresa)
    {

      $lista = $this->get("agp.lista.manager")->findById($lista);
      $terminalEmpresa = $this->get("agp.terminalEmpresa.manager")->findById($terminalEmpresa);
      
      if (!$lista){
          throw $this->createNotFoundException("A lista não foi encontrado.");
      }
      
      if (!$this->isValidAccess($lista)){
            throw new AccessDeniedException;
      }
      
      if (!$this->isValidAccess($terminalEmpresa)){
            throw new AccessDeniedException;
      }
      
      $manager = $this->get("agp.habilitaProdutoTerminal.manager");
      $manager->habilitaProdutoTerminal($lista, $terminalEmpresa);

      return new JsonResponse(array("status" => "sucesso"));
  
    }
    
    /**
     * @Route("/{id}/edit/", name="habilitaProdutoTerminalEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $entity = $this->get("agp.habilitaProdutoTerminal.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A habilitaProdutoTerminal com id ".$id." não foi encontrado.");
      }
     
      $formHandler = $this->get("agp.habilitaProdutoTerminal.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity);  
    }
     
    /**
     * @Route("/{id}/delete", name="habilitaProdutoTerminalDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $habilitaProdutoTerminal = $this->get("agp.habilitaProdutoTerminal.manager")->findById($id);
      
      if (!$habilitaProdutoTerminal){
          throw $this->createNotFoundException("A habilitaProdutoTerminal com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.habilitaProdutoTerminal.manager")->remove($habilitaProdutoTerminal);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete/delete-group", name="habilitaProdutoTerminalGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $habilitaProdutoTerminals = $this->get("request")->request->get("registros");
        foreach ($habilitaProdutoTerminals as $habilitaProdutoTerminalId)
        {
            $habilitaProdutoTerminal = $this->get("agp.habilitaProdutoTerminal.manager")->findById($habilitaProdutoTerminalId);;
            if (!$habilitaProdutoTerminal)
                throw $this->createNotFoundException("A habilitaProdutoTerminal com id ".$habilitaProdutoTerminalId." não foi encontrado.");
            $this->get("agp.habilitaProdutoTerminal.manager")->remove($habilitaProdutoTerminal);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/situacao/change-situacao-group/{id}", name="habilitaProdutoTerminalChangeSituacao", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function changeSituacaoAction($id)
    {
        $habilitaProdutoTerminal = $this->get("agp.habilitaProdutoTerminal.manager")->findById($id);
        
        if (!$habilitaProdutoTerminal)
                throw $this->createNotFoundException("A habilitaProdutoTerminal com id ".$id." não foi encontrado.");
        
        $this->get("agp.habilitaProdutoTerminal.manager")->changeSituacao($habilitaProdutoTerminal);
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/situacao/change-situacao", name="habilitaProdutoTerminalChangeSituacaoGroup", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function changeSituacaoGroupAction()
    {
        $habilitaProdutoTerminals = $this->get("request")->request->get("registros");
        foreach ($habilitaProdutoTerminals as $habilitaProdutoTerminalId)
        {
            $habilitaProdutoTerminal = $this->get("agp.habilitaProdutoTerminal.manager")->findById($habilitaProdutoTerminalId);;
            if (!$habilitaProdutoTerminal)
                throw $this->createNotFoundException("A habilitaProdutoTerminal com id ".$habilitaProdutoTerminalId." não foi encontrado.");
            $this->get("agp.habilitaProdutoTerminal.manager")->changeSituacao($habilitaProdutoTerminal);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/habilitaProdutoTerminalAjax/{terminalEmpresa}", name="habilitaProdutoTerminalAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function habilitaProdutoTerminalAjaxAction($terminalEmpresa)
    {
        $entities["aaData"] = $this->getDoctrine()->getRepository("AgpAdminBundle:HabilitaProdutoTerminal")->getHabilitaProdutoTerminalByTerminal($terminalEmpresa);
        return new JsonResponse($entities);
    }

}

?>
