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
 * Description of ListaController
 *
 * @author bondcs
 * @Route("/usuario/lista")
 */
class ListaController extends Controller{
    
    /**
     * @Route("/", name="listaIndex")
     * @Template("")
     */
    public function indexAction()
    {    
        return array();
    }
    
    /**
     * @Route("/add", name="listaAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction()
    {
      $form = $this->get("agp.lista.form");
      $formHandler = $this->get("agp.lista.form.handler");
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $form->createView());  
    }
    
    /**
     * @Route("/{id}/edit", name="listaEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $lista = $this->get("agp.lista.manager")->findById($id);
      
      if (!$lista){
          throw $this->createNotFoundException("A lista com id ".$id." não foi encontrado.");
      }
      
      if (!$this->isValidAccess($lista)){
            throw new AccessDeniedException;
      }
        
      $form = $this->get("agp.lista.form");
      $formHandler = $this->get("agp.lista.form.handler");
      if ($formHandler->process($lista)){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $form->createView(),
                   'entity' => $lista);  
    }
    
    /**
     * @Route("/{id}/delete", name="listaDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $lista = $this->get("agp.lista.manager")->findById($id);
      
      if (!$lista){
          throw $this->createNotFoundException("A lista com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.lista.manager")->deleteLista($lista);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group", name="listaGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $listas = $this->get("request")->request->get("listas");
        foreach ($listas as $listaId)
        {
            $lista = $this->get("agp.lista.manager")->findById($listaId);;
            if (!$lista)
                throw $this->createNotFoundException("A lista com id ".$id." não foi encontrado.");
            $this->get("agp.lista.manager")->deleteLista($lista);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/lista-ajax", name="listaAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function listaAjaxAction()
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT l FROM AgpAdminBundle:ListaPreco l WHERE l.empresa = :empresa")->setParameters(array("empresa" => $this->getUser()->getEmpresa()))->getArrayResult();
        return new JsonResponse($entities);
    }
    
    public function setFlash($tipo, $msg){
        $session = $this->get("session");
        $session->setFlash($tipo, $msg);
    }
}

?>
