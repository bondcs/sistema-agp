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

/**
 * Description of AtendenteController
 *
 * @author bondcs
 * @Route("/usuario/atendente")
 */
class AtendenteController extends Controller{
    
    /**
     * @Route("/", name="atendenteIndex")
     * @Template("")
     */
    public function indexAction()
    {    
        $entities = $this->get("agp.atendente.manager")->findAll(); 
        
        return array("entities" => $entities );
    }
    
    /**
     * @Route("/add", name="atendenteAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction()
    {
      $form = $this->get("agp.atendente.form");
      $formHandler = $this->get("agp.atendente.form.handler");
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $form->createView());  
    }
    
    /**
     * @Route("/{id}/edit", name="atendenteEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $atendente = $this->get("agp.atendente.manager")->findById($id);
      
      if (!$atendente){
          throw $this->createNotFoundException("A atendente com id ".$id." não foi encontrado.");
      }
      
      if (!$this->isValidAccess($atendente)){
            throw new AccessDeniedException;
      }
        
      $form = $this->get("agp.atendente.form");
      $formHandler = $this->get("agp.atendente.form.handler");
      if ($formHandler->process($atendente)){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $form->createView(),
                   'entity' => $atendente);  
    }
    
    /**
     * @Route("/{id}/delete", name="atendenteDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $atendente = $this->get("agp.atendente.manager")->findById($id);
      
      if (!$atendente){
          throw $this->createNotFoundException("A atendente com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.atendente.manager")->deleteAtendente($atendente);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group", name="atendenteGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $atendentes = $this->get("request")->request->get("atendentes");
        foreach ($atendentes as $atendenteId)
        {
            $atendente = $this->get("agp.atendente.manager")->findById($atendenteId);;
            if (!$atendente)
                throw $this->createNotFoundException("A atendente com id ".$id." não foi encontrado.");
            $this->get("agp.atendente.manager")->deleteAtendente($atendente);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/atendente-ajax", name="atendenteAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function atendenteAjaxAction()
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT a FROM AgpAdminBundle:Atendente a WHERE a.empresa = :empresa")->setParameters(array("empresa" => $this->getUser()->getEmpresa()))->getArrayResult();
        return new JsonResponse($entities);
    }
    
    public function setFlash($tipo, $msg){
        $session = $this->get("session");
        $session->setFlash($tipo, $msg);
    }
}

?>
