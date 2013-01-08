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
use Agp\AdminBundle\Entity\Dummy\TerminalDummy;
use Agp\AdminBundle\Entity\TerminalPreco;
use Agp\AdminBundle\Form\Dummy\TerminalDummyType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of TerminalController
 *
 * @author bondcs
 */
class TerminalController extends Controller{
    
    /**
     * @Route("/admin/terminal/", name="terminalIndex", options={"expose" = true})
     * @Template("")
     */
    public function indexAction()
    {    
        return array();
    }
  
    
    /**
     * @Route("/admin/terminal/add/", name="terminalAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction()
    {

      $formHandler = $this->get("agp.terminal.form.handler");
      $formHandler->useInsertEstrategia();
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView());  
    }
    
    /**
     * @Route("/admin/terminal/{id}/edit/", name="terminalEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $entity = $this->get("agp.terminal.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A terminal com id ".$id." não foi encontrado.");
      }
     
      $formHandler = $this->get("agp.terminal.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity);  
    }
     
    /**
     * @Route("/admin/terminal/{id}/delete", name="terminalDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $terminal = $this->get("agp.terminal.manager")->findById($id);
      
      if (!$terminal){
          throw $this->createNotFoundException("A terminal com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.terminal.manager")->remove($terminal);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/admin/terminal/delete-group", name="terminalGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $terminals = $this->get("request")->request->get("registros");
        foreach ($terminals as $terminalId)
        {
            $terminal = $this->get("agp.terminal.manager")->findById($terminalId);;
            if (!$terminal)
                throw $this->createNotFoundException("A terminal com id ".$terminalId." não foi encontrado.");
            $this->get("agp.terminal.manager")->remove($terminal);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/admin/terminal/terminalAjax", name="terminalAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function terminalAjaxAction()
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT t FROM AgpAdminBundle:Terminal t")->getArrayResult();
        return new JsonResponse($entities);
    }
    
    /**
     * @Route("/admin/terminal/{id}/show-admin", name="showByAdmin", options={"expose" = true})
     * @Template("")
     */
    public function showByAdminAction($id){
        $entity = $this->get("agp.terminal.manager")->findById($id);
        return array("entity" => $entity);
    }
    
    /**
     * @Route("/usuario/terminal/{id}/show", name="showByUser", options={"expose" = true})
     * @Template("")
     */
    public function showByUserAction($id){
        
        $entity = $this->get("agp.terminalEmpresa.manager")->findById($id);   
        if (!$this->isValidAccess($entity)){
            throw new AccessDeniedException;
        }
        
        return array("entity" => $entity);
    }


}

?>
