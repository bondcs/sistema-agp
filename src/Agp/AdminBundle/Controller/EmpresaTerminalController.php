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
 * @Route("/admin/empresa/empresa-terminal")
 */
class EmpresaTerminalController extends Controller{
    
    /**
     * @Route("/{id}/show", name="empresaTerminal", options={"expose" = true})
     * @Template("")
     */
    public function indexAction($id){
        $entity = $this->get("agp.empresa.manager")->findById($id);
        return array("entity" => $entity);
    }

    /**
     * @Route("/add/{empresaId}", name="empresaTerminalAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction($empresaId)
    {
     
      $empresa = $this->get("agp.empresa.manager")->findById($empresaId);
        
      $formHandler = $this->get("agp.empresaTerminal.form.handler");
      $formHandler->useInsertEstrategia();
      $formHandler->setOptions(array("empresaId" => $empresaId));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'empresaId' => $empresaId);
    }
        
    /**
     * @Route("/{id}/edit/lala/", name="empresaTerminalEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $entity = $this->get("agp.terminalEmpresa.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A terminalEmpresa com id ".$id." não foi encontrado.");
      }
     
      $formHandler = $this->get("agp.empresaTerminal.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity);  
    }

    /**
     * @Route("/{id}/delete", name="empresaTerminalDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $entity = $this->get("agp.terminalEmpresa.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A terminalEmpresa com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.terminalEmpresa.manager")->remove($entity);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group", name="empresaTerminalGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $terminalEmpresas = $this->get("request")->request->get("registros");
        foreach ($terminalEmpresas as $terminalEmpresaId)
        {
            $entity = $this->get("agp.terminalEmpresa.manager")->findById($terminalEmpresaId);;
            if (!$entity)
                throw $this->createNotFoundException("A terminalEmpresa com id ".$terminalEmpresaId." não foi encontrado.");
            $this->get("agp.terminalEmpresal.manager")->remove($entity);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/empresaTerminalAjax/{id}", name="empresaTerminalAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function empresaTerminalAjaxAction($id)
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT te,t,e FROM AgpAdminBundle:TerminalEmpresa te JOIN te.terminal t JOIN te.empresa e WHERE e.codEmpresa = :id ORDER BY te.situacao")->setParameters(array("id" => $id))->getArrayResult();
        return new JsonResponse($entities);
    }
    
    /**
     * @Route("/{id}/situacaoCheck-empresaTerminal", name="empresaTerminalSituacaoCheck", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function situacaoCheckAction($id)
    {
      $entity = $this->get("agp.terminalEmpresa.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A empresaTerminal com id ".$id." não foi encontrado.");
      }
      
      if ($this->get("agp.terminalEmpresa.manager")->updateSituacao($entity)){
          return new JsonResponse(array("status" => "sucesso"));;
      }else{
          return new JsonResponse(array("status" => "fail"));;
      }
    }
    
     /**
     * @Route("/situacao/change-situacao", name="empresaTerminalChangeSituacaoGroup", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function changeSituacaoGroupAction()
    {
        $empresaTerminals = $this->get("request")->request->get("registros");
        foreach ($empresaTerminals as $empresaTerminalId)
        {
            $empresaTerminal = $this->get("agp.terminalEmpresa.manager")->findById($empresaTerminalId);;
            if (!$empresaTerminal)
                throw $this->createNotFoundException("A empresaTerminal com id ".$empresaTerminalId." não foi encontrado.");
            $this->get("agp.terminalEmpresa.manager")->updateSituacao($empresaTerminal);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
}

?>
