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
use Agp\AdminBundle\Entity\EntradaProduto;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of EController
 *
 * @author bondcs
 * @Route("/usuario/entrada-produto")
 */
class EntradaProdutoController extends Controller{
    
    /**
     * @Route("/{id}", name="entradaProdutoIndex", options={"expose" = true})
     * @Template("")
     */
    public function indexAction($id)
    {    
        $produto = $this->get("agp.produto.manager")->findById($id);     
        if (!$produto)
                throw $this->createNotFoundException("A produto com id ".$id." não foi encontrado.");
        
        if (!$this->isValidAccess($produto))
                throw new AccessDeniedException;
        
        
        return (array("entity" => $produto));
    }
  
    
    /**
     * @Route("/add/", name="entradaProdutoAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction(Request $request)
    {
      $id = $request->get("produto");
      $produto = $this->get("agp.produto.manager")->findById($id);     
      if (!$produto)
            throw $this->createNotFoundException("A produto com id ".$id." não foi encontrado.");

      if (!$this->isValidAccess($produto))
                throw new AccessDeniedException;
      
      $formHandler = $this->get("agp.entradaProduto.form.handler");
      $formHandler->useInsertEstrategia();
      $formHandler->setOptions(array("produto" => $produto));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $produto);  
    }
    
    /**
     * @Route("/{id}/edit/", name="entradaProdutoEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $entity = $this->get("agp.entradaProduto.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A entradaProduto com id ".$id." não foi encontrado.");
      }
      
      if (!$this->isValidAccess($entity->getProduto()))
                throw new AccessDeniedException;
     
      $formHandler = $this->get("agp.entradaProduto.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity);  
    }
     
    /**
     * @Route("/{id}/delete", name="entradaProdutoDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $entradaProduto = $this->get("agp.entradaProduto.manager")->findById($id);
      
      if (!$entradaProduto){
          throw $this->createNotFoundException("A entradaProduto com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.entradaProduto.manager")->remove($entradaProduto);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group/", name="entradaProdutoGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $entradaProdutos = $this->get("request")->request->get("registros");
        foreach ($entradaProdutos as $entradaProdutoId)
        {
            $entradaProduto = $this->get("agp.entradaProduto.manager")->findById($entradaProdutoId);;
            if (!$entradaProduto)
                throw $this->createNotFoundException("A entradaProduto com id ".$entradaProdutoId." não foi encontrado.");
            $this->get("agp.entradaProduto.manager")->remove($entradaProduto);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/entradaProdutoAjax/{id}", name="entradaProdutoAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function entradaProdutoAjaxAction($id)
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT e,p,f FROM AgpAdminBundle:EntradaProduto e JOIN e.produto p JOIN e.fornecedor f WHERE p.codProduto = :id ORDER BY e.codEntradaProduto DESC")->setParameter("id", $id)->getArrayResult();
        return new JsonResponse($entities);
    } 

}

?>
