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
use Agp\AdminBundle\Entity\Dummy\ProdutoListaDummy;
use Agp\AdminBundle\Entity\ProdutoListaPreco;
use Agp\AdminBundle\Form\Dummy\ProdutoListaDummyType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ListaController
 *
 * @author bondcs
 * @Route("/usuario/produto-lista")
 */
class ProdutoListaController extends Controller{
    
    /**
     * @Route("/lista/{id}", name="produtoListaIndex", options={"expose" = true})
     * @Template("")
     */
    public function indexAction($id)
    {    
        $entity = $this->get("agp.lista.manager")->findById($id);
      
        if (!$entity){
            throw $this->createNotFoundException("A Lista com id ".$id." não foi encontrado.");
        }
        
        if (!$this->isValidAccess($entity)){
            throw new AccessDeniedException;
        }
        
        return array("entity" => $entity);
    }
    
    /**
     * @Route("/add/{listaId}", name="produtoListaAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction($listaId)
    {
      
      $entity = $this->get("agp.lista.manager")->findById($listaId);
      if (!$this->isValidAccess($entity)){
            throw new AccessDeniedException;
      }
      
      $formHandler = $this->get("agp.produtoLista.form.handler");
      $formHandler->useInsertEstrategia();
      $formHandler->setOptions(array("lista" => $listaId));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'listaId' => $listaId);  
    }
    
    /**
     * @Route("/add-group/{listaId}", name="produtoListaGroupAdd", options={"expose" = true})
     * @Template("")
     */
    public function addGroupAction(Request $request, $listaId){
        
        $entityLista = $this->get("agp.lista.manager")->findById($listaId);
            if (!$this->isValidAccess($entityLista)){
                  throw new AccessDeniedException;
        }
        
        $produtoListas = new ProdutoListaDummy;
        $produtoListas->getProdutoListas()->add(new ProdutoListaPreco);
        
        $produtoListaType = $this->get("agp.produtoLista.form.type");
        $form = $this->createForm(new ProdutoListaDummyType(array("produtoListaType" => $produtoListaType)), $produtoListas);
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $manager = $this->get("agp.produtoLista.manager");
                foreach ($produtoListas->getProdutoListas() as $produtoLista) {
                    $manager->save($produtoLista, $listaId);
                }
                
                $this->setFlash("sucess", "Produto(s) Adicionado(s) na Lista");
                return $this->redirect($this->generateUrl("produtoListaIndex", array("id" => $listaId)));
            }
        }
        return array(
            'produtoListas' => $produtoListas,
            'form'    => $form->createView(),
            'entity' => $entityLista,
        );
        
    }
    
    /**
     * @Route("/{id}/edit/{listaId}", name="produtoListaEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id, $listaId)
    {
      $entity = $this->get("agp.produtoLista.manager")->findById($id);
      
      if (!$entity){
          throw $this->createNotFoundException("A produtoLista com id ".$id." não foi encontrado.");
      }
     
      if (!$this->isValidAccess($entity)){
            throw new AccessDeniedException;
      }
      
      $entityLista = $this->get("agp.lista.manager")->findById($listaId);
      if (!$this->isValidAccess($entityLista)){
            throw new AccessDeniedException;
      }
      
      
      $formHandler = $this->get("agp.produtoLista.form.handler");
      $formHandler->useUpdateEstrategia();
      $formHandler->setOptions(array("entity" => $entity, "lista" => $listaId));
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $formHandler->getForm()->createView(),
                   'entity' => $entity,
                   'listaId' => $listaId);  
    }
    
    /**
     * @Route("/edit-group/{listaId}", name="produtoListaGroupEdit", options={"expose" = true})
     * @Template("")
     */
    public function editGroupAction(Request $request, $listaId){
        
        $entityLista = $this->get("agp.lista.manager")->findById($listaId);
        if (!$this->isValidAccess($entityLista)){
              throw new AccessDeniedException;
        }
        
        $produtoListas = $request->get("registros");
        $produtoListaDummy = new ProdutoListaDummy;
        foreach ($produtoListas  as $produtoListaId)
        {
            $produtoLista = $this->get("agp.produtoLista.manager")->findById($produtoListaId);
            if (!$produtoLista)
                throw $this->createNotFoundException("A produto com id ".$produtoListaId." não foi encontrado.");
            $produtoListaDummy->getProdutoListas()->add($produtoLista);
            
        }
        
        
        $produtoListaType = $this->get("agp.produtoLista.form.type");
        $form = $this->createForm(new ProdutoListaDummyType(array("produtoListaType" => $produtoListaType)), $produtoListaDummy);
       
        return array(
            'form'    => $form->createView(),
            'entity' => $entityLista
        );
        
    }
    
    /**
     * @Route("/update-group/{listaId}", name="produtoListaGroupUpdate", options={"expose" = true})
     * @Template("AgpAdminBundle:Produto:editGroup.html.twig")
     * @Method({"post"})
     */
    public function updateGroupAction(Request $request, $listaId){
       
        $entityLista = $this->get("agp.lista.manager")->findById($listaId);
            if (!$this->isValidAccess($entityLista)){
                  throw new AccessDeniedException;
        }
        
        $produtoListas = new ProdutoListaDummy;
        $produtoListaType = $this->get("agp.produtoLista.form.type");
        $form = $this->createForm(new ProdutoListaDummyType(array("produtoListaType" => $produtoListaType)), $produtoListas);
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
           
            if ($form->isValid()) {
                $manager = $this->get("agp.produtoLista.manager");
                
                foreach ($produtoListas->getProdutoListas() as $produto) {
                    $manager->save($produto, $listaId);
                }
                
                $this->setFlash("sucess", "Produto(s) Alterados(s) na Lista");
                return $this->redirect($this->generateUrl("produtoListaIndex", array("id" => $listaId)));
            }
        }
        return array(
            'form'    => $form->createView(),
            'entity' => $entityLista,
        );
    }
    
    
    /**
     * @Route("/{id}/delete", name="produtoListaDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $produtoLista = $this->get("agp.produtoLista.manager")->findById($id);
      
      if (!$produtoLista){
          throw $this->createNotFoundException("A produtoLista com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.produtoLista.manager")->deleteProdutoLista($produtoLista);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group", name="produtoListaGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $produtoListas = $this->get("request")->request->get("registros");
        foreach ($produtoListas as $produtoListaId)
        {
            $produtoLista = $this->get("agp.produtoLista.manager")->findById($produtoListaId);;
            if (!$produtoLista)
                throw $this->createNotFoundException("A produtoLista com id ".$produtoListaId." não foi encontrado.");
            $this->get("agp.produtoLista.manager")->deleteProdutoLista($produtoLista);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/produtoListaAjax/{id}", name="produtoListaAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function produtoListaAjaxAction($id)
    {
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT pl, p FROM AgpAdminBundle:ProdutoListaPreco pl JOIN pl.produto p JOIN pl.listaPreco l WHERE l.codListaPreco = :id AND p.empresa = :empresa ")->setParameters(array("id" => $id, "empresa" => $this->getUser()->getEmpresa()))->getArrayResult();
        return new JsonResponse($entities);
    }
    
    public function setFlash($tipo, $msg){
        $session = $this->get("session");
        $session->setFlash($tipo, $msg);
    }
}

?>
