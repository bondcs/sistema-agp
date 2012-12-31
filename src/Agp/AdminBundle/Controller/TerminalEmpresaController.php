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
use Agp\AdminBundle\Entity\TerminalEmpresa;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ListaController
 *
 * @author bondcs
 * @Route("/admin/terminal/terminal-empresa")
 */
class TerminalEmpresaController extends Controller{
    
    /**
     * @Route("/{id}/show", name="terminalEmpresaByTerminal", options={"expose" = true})
     * @Template("")
     */
    public function indexByTerminalAction($id){
        $entity = $this->get("agp.terminal.manager")->findById($id);
        return array("entity" => $entity);
    }

    /**
     * @Route("/add/{terminalId}", name="terminalEmpresaAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction($terminalId)
    {
     
      $formHandler = $this->get("agp.terminalEmpresa.form.handler");
      $formHandler->useInsertEstrategia();
      $formHandler->setOptions(array("terminalId" => $terminalId));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'terminalId' => $terminalId);
    }
        
    /**
     * @Route("/{id}/edit", name="terminalEmpresaEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $entity = $this->get("agp.terminalEmpresa.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A terminalEmpresa com id ".$id." não foi encontrado.");
      }
     
      $formHandler = $this->get("agp.terminalEmpresa.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity);  
    }

    /**
     * @Route("/{id}/delete", name="terminalEmpresaDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $terminalEmpresa = $this->get("agp.terminalEmpresa.manager")->findById($id);
      
      if (!$terminalEmpresa){
          throw $this->createNotFoundException("A terminalEmpresa com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.terminalEmpresa.manager")->remove($terminalEmpresa);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group", name="terminalEmpresaGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $terminalEmpresas = $this->get("request")->request->get("registros");
        foreach ($terminalEmpresas as $terminalEmpresaId)
        {
            $terminalEmpresa = $this->get("agp.terminalEmpresa.manager")->findById($terminalEmpresaId);;
            if (!$terminalEmpresa)
                throw $this->createNotFoundException("A terminalEmpresa com id ".$terminalEmpresaId." não foi encontrado.");
            $this->get("agp.terminalEmpresa.manager")->remove($terminalEmpresa);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/terminalEmpresaAjax/{id}", name="terminalEmpresaAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function terminalEmpresaAjaxAction($id)
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT te,t,e FROM AgpAdminBundle:TerminalEmpresa te JOIN te.terminal t JOIN te.empresa e WHERE t.codTerminal = :id ORDER BY te.situacao")->setParameters(array("id" => $id))->getArrayResult();
        return new JsonResponse($entities);
    }
    
    /**
     * @Route("/{id}/situacaoCheck-terminalEmpresa", name="terminalSituacaoCheck", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function situacaoCheckAction($id)
    {
      $terminalEmpresa = $this->get("agp.terminalEmpresa.manager")->findById($id);
      
      if (!$terminalEmpresa){
          throw $this->createNotFoundException("A terminalEmpresa com id ".$id." não foi encontrado.");
      }
      
      if ($this->get("agp.terminalEmpresa.manager")->updateSituacao($terminalEmpresa)){
          return new JsonResponse(array("status" => "sucesso"));;
      }else{
          return new JsonResponse(array("status" => "fail"));;
      }

      
        
    }
}

?>
