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
use Agp\AdminBundle\Entity\Pessoa;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ListaController
 *
 * @author bondcs
 */
class PessoaController extends Controller{
    
    /**
     * @Route("/admin/pessoa/", name="pessoaIndex", options={"expose" = true})
     * @Template("")
     */
    public function indexAction(Request $request)
    {    
        $empresa = $this->get("agp.empresa.manager")->findById($request->get("id"));
        return array('entity' => $empresa);
    }
  
    
    /**
     * @Route("/admin/pessoa/add/{empresaId}", name="pessoaAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction($empresaId)
    {
      
      $empresa = $this->get("agp.empresa.manager")->findById($empresaId);
      $formHandler = $this->get("agp.pessoa.form.handler");
      $formHandler->setOptions(array("empresa" => $empresa));
      $formHandler->useInsertEstrategia();
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'empresaId' => $empresaId);  
    }
    
    /**
     * @Route("/admin/pessoa/{id}/edit/", name="pessoaEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $entity = $this->get("agp.pessoa.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A pessoa com id ".$id." não foi encontrado.");
      }
     
      $formHandler = $this->get("agp.pessoa.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity);  
    }
     
    /**
     * @Route("/admin/pessoa/{id}/delete", name="pessoaDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $pessoa = $this->get("agp.pessoa.manager")->findById($id);
      
      if (!$pessoa){
          throw $this->createNotFoundException("A pessoa com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.pessoa.manager")->remove($pessoa);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/admin/pessoa/delete-group", name="pessoaGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $pessoas = $this->get("request")->request->get("registros");
        foreach ($pessoas as $pessoaId)
        {
            $pessoa = $this->get("agp.pessoa.manager")->findById($pessoaId);;
            if (!$pessoa)
                throw $this->createNotFoundException("A pessoa com id ".$pessoaId." não foi encontrado.");
            $this->get("agp.pessoa.manager")->remove($pessoa);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/admin/pessoa/pessoaAjax", name="pessoaAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function pessoaAjaxAction(Request $request)
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT p FROM AgpAdminBundle:Pessoa p WHERE p.empresa = :id")
                ->setParameters(array("id" => $request->get("id")))
                ->getArrayResult();
        return new JsonResponse($entities);
    }
}

?>
