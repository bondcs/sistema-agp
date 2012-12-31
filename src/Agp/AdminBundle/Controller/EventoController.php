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
 * Description of EventoController
 *
 * @author bondcs
 * @Route("/usuario/evento")
 */
class EventoController extends Controller{
    
    /**
     * @Route("/", name="eventoIndex")
     * @Template("")
     */
    public function indexAction()
    {    
        $entities = $this->get("agp.evento.manager")->findAll(); 
        
        return array("entities" => $entities );
    }
    
    /**
     * @Route("/add", name="eventoAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction()
    {
      $form = $this->get("agp.evento.form");
      $formHandler = $this->get("agp.evento.form.handler");
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $form->createView());  
    }
    
    /**
     * @Route("/{id}/edit", name="eventoEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $evento = $this->get("agp.evento.manager")->findById($id);
      
      if (!$evento){
          throw $this->createNotFoundException("A evento com id ".$id." não foi encontrado.");
      }
      
      if (!$this->isValidAccess($evento)){
            throw new AccessDeniedException;
      }
        
      $form = $this->get("agp.evento.form");
      $formHandler = $this->get("agp.evento.form.handler");
      if ($formHandler->process($evento)){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $form->createView(),
                   'entity' => $evento);  
    }
    
    /**
     * @Route("/{id}/delete", name="eventoDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $evento = $this->get("agp.evento.manager")->findById($id);
      
      if (!$evento){
          throw $this->createNotFoundException("A evento com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.evento.manager")->deleteEvento($evento);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group", name="eventoGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $eventos = $this->get("request")->request->get("eventos");
        foreach ($eventos as $eventoId)
        {
            $evento = $this->get("agp.evento.manager")->findById($eventoId);;
            if (!$evento)
                throw $this->createNotFoundException("A evento com id ".$id." não foi encontrado.");
            $this->get("agp.evento.manager")->deleteEvento($evento);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/evento-ajax", name="eventoAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function eventoAjaxAction()
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT e FROM AgpAdminBundle:Evento e WHERE e.empresa = :empresa")->setParameters(array("empresa" => $this->getUser()->getEmpresa()))->getArrayResult();
        return new JsonResponse($entities);
    }
    
    public function setFlash($tipo, $msg){
        $session = $this->get("session");
        $session->setFlash($tipo, $msg);
    }
}

?>
