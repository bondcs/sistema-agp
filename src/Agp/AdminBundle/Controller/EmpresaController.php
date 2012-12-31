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
use Agp\AdminBundle\Entity\Dummy\EmpresaDummy;
use Agp\AdminBundle\Entity\EmpresaPreco;
use Agp\AdminBundle\Form\Dummy\EmpresaDummyType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ListaController
 *
 * @author bondcs
 * @Route("/admin/empresa")
 */
class EmpresaController extends Controller{
    
    /**
     * @Route("/", name="empresaIndex", options={"expose" = true})
     * @Template("")
     */
    public function indexAction()
    {    
        return array();
    }
  
    
    /**
     * @Route("/add/", name="empresaAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction()
    {

      $formHandler = $this->get("agp.empresa.form.handler");
      $formHandler->useInsertEstrategia();
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView());  
    }
    
    /**
     * @Route("/{id}/edit/", name="empresaEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $entity = $this->get("agp.empresa.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A empresa com id ".$id." não foi encontrado.");
      }
     
      $formHandler = $this->get("agp.empresa.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity);  
    }
     
    /**
     * @Route("/{id}/delete", name="empresaDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $empresa = $this->get("agp.empresa.manager")->findById($id);
      
      if (!$empresa){
          throw $this->createNotFoundException("A empresa com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.empresa.manager")->remove($empresa);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group", name="empresaGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $empresas = $this->get("request")->request->get("registros");
        foreach ($empresas as $empresaId)
        {
            $empresa = $this->get("agp.empresa.manager")->findById($empresaId);;
            if (!$empresa)
                throw $this->createNotFoundException("A empresa com id ".$empresaId." não foi encontrado.");
            $this->get("agp.empresa.manager")->remove($empresa);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/empresaAjax", name="empresaAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function empresaAjaxAction()
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT e,c FROM AgpAdminBundle:Empresa e JOIN e.cidade c")->getArrayResult();
        return new JsonResponse($entities);
    }
    
    /**
     * @Route("/{id}/show", name="showEmpresa", options={"expose" = true})
     * @Template("")
     */
    public function showAction($id){
        
        $entity = $this->get("agp.empresa.manager")->findById($id);   
        return array("entity" => $entity);
    }

}

?>
