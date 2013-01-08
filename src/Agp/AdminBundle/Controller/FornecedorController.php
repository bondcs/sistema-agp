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
use Agp\AdminBundle\Entity\Dummy\FornecedorDummy;
use Agp\AdminBundle\Entity\FornecedorPreco;
use Agp\AdminBundle\Form\Dummy\FornecedorDummyType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of FornecedorController
 *
 * @author bondcs
 */
class FornecedorController extends Controller{
    
    /**
     * @Route("/usuario/fornecedor/", name="fornecedorIndex", options={"expose" = true})
     * @Template("")
     */
    public function indexAction()
    {    
        return array();
    }
  
    
    /**
     * @Route("/usuario/fornecedor/add/", name="fornecedorAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction()
    {

      $formHandler = $this->get("agp.fornecedor.form.handler");
      $formHandler->useInsertEstrategia();
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView());  
    }
    
    /**
     * @Route("/add-fast", name="fornecedorAddFast", options={"expose" = true})
     * @Template("")
     */
    public function addFastAction()
    {
      $formHandler = $this->get("agp.fornecedor.form.handler");
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso", "form" => $this->renderView("AgpAdminBundle:Fornecedor:addFast.html.twig", array('form' => $formHandler->getFormView()))));
      }
        
      return array('form' => $formHandler->getForm()->createView());  
    }
       
    /**
     * @Route("/fornecedor-select-ajax", name="getSelectFornecedorAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function fornecedorSelectAjaxAction()
    {
        $entities = $this->getDoctrine()->getEntityManager()->createQuery("SELECT f.codFornecedor as id, f.razaoSocial as nome FROM AgpAdminBundle:Fornecedor f WHERE f.empresa = :empresa")->setParameters(array("empresa" => $this->getUser()->getEmpresa()))->getResult();
        return new JsonResponse($entities);
    }
    
    /**
     * @Route("/usuario/fornecedor/{id}/edit/", name="fornecedorEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $entity = $this->get("agp.fornecedor.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A fornecedor com id ".$id." não foi encontrado.");
      }
     
      $formHandler = $this->get("agp.fornecedor.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity);  
    }
     
    /**
     * @Route("/usuario/fornecedor/{id}/delete", name="fornecedorDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $fornecedor = $this->get("agp.fornecedor.manager")->findById($id);
      
      if (!$fornecedor){
          throw $this->createNotFoundException("A fornecedor com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.fornecedor.manager")->remove($fornecedor);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/usuario/fornecedor/delete-group", name="fornecedorGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $fornecedors = $this->get("request")->request->get("registros");
        foreach ($fornecedors as $fornecedorId)
        {
            $fornecedor = $this->get("agp.fornecedor.manager")->findById($fornecedorId);;
            if (!$fornecedor)
                throw $this->createNotFoundException("A fornecedor com id ".$fornecedorId." não foi encontrado.");
            $this->get("agp.fornecedor.manager")->remove($fornecedor);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/usuario/fornecedor/fornecedorAjax", name="fornecedorAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function fornecedorAjaxAction()
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT f FROM AgpAdminBundle:Fornecedor f")->getArrayResult();
        return new JsonResponse($entities);
    }

}

?>
