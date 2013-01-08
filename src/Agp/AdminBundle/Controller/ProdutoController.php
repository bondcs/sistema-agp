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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Agp\AdminBundle\Entity\Dummy\ProdutoDummy;
use Agp\AdminBundle\Entity\Produto;
use Agp\AdminBundle\Form\Type\ProdutoType;
use Agp\AdminBundle\Form\Dummy\ProdutoDummyType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Description of ProdutoController
 *
 * @author bondcs
 * @Route("/usuario/produto")
 */
class ProdutoController extends Controller{
    
    /**
     * @Route("/", name="produtoIndex")
     * @Template("")
     */
    public function indexAction()
    {    
        $entities = $this->get("agp.produto.manager")->findAll(); 
        
        return array("entities" => $entities );
    }
    
    /**
     * @Route("/add", name="produtoAdd", options={"expose" = true})
     * @Template("")
     */
    public function addAction()
    {
      $form = $this->get("agp.produto.form");
      $formView = $form->createView();
      $formHandler = $this->get("agp.produto.form.handler");
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso", "form" => $this->renderView("AgpAdminBundle:Produto:add.html.twig", array('form' => $formView))));
      }
        
      return array('form' => $form->createView());  
    }
    
    /**
     * @Route("/add-fast", name="produtoAddFast", options={"expose" = true})
     * @Template("")
     */
    public function addFastAction()
    {
      $form = $this->get("agp.produto.form");
      $formView = $form->createView();
      $formHandler = $this->get("agp.produto.form.handler");
      
      if ($formHandler->process()){
          return new JsonResponse(array("status" => "sucesso", "form" => $this->renderView("AgpAdminBundle:Produto:addFast.html.twig", array('form' => $formView))));
      }
        
      return array('form' => $form->createView());  
    }
    
    /**
     * @Route("/get-produto/{id}", name="getProduto", options={"expose" = true})
     * @Template("")
     */
    public function getProdutoAction($id)
    {
      $produto = $this->get("agp.produto.manager")->findById($id);
      return new JsonResponse($produto->getVlrBase());
    }
    
    /**
     * @Route("/produto-select-ajax", name="getSelectProdutosAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function produtoSelectAjaxAction()
    {
        $entities = $this->getDoctrine()->getEntityManager()->createQuery("SELECT p.codProduto as id, p.nome as nome FROM AgpAdminBundle:Produto p WHERE p.empresa = :empresa")->setParameters(array("empresa" => $this->getUser()->getEmpresa()))->getResult();
        return new JsonResponse($entities);
    }
    
    
    
    /**
     * @Route("/add-group", name="produtoGroupAdd", options={"expose" = true})
     * @Template("")
     */
    public function addGroupAction(Request $request){
        
        $produtos = new ProdutoDummy;
        $produtos->getProdutos()->add(new Produto);
        $form = $this->createForm(new ProdutoDummyType, $produtos);
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $manager = $this->get("agp.produto.manager");
                foreach ($produtos->getProdutos() as $produto) {
                    $manager->saveProduto($produto);
                }
                
                $this->setFlash("sucess", "Produto(s) Adicionado(s)");
                return $this->redirect($this->generateUrl("produtoIndex"));
            }
        }
        return array(
            'produtos' => $produtos,
            'form'    => $form->createView()
        );
        
    }

        /**
     * @Route("/{id}/edit", name="produtoEdit", options={"expose" = true})
     * @Template("")
     */
    public function editAction($id)
    {
      $produto = $this->get("agp.produto.manager")->findById($id);
      
      if (!$produto){
          throw $this->createNotFoundException("A produto com id ".$id." não foi encontrado.");
      }
      
      if (!$this->isValidAccess($produto)){
            throw new AccessDeniedException;
      }
        
      $form = $this->get("agp.produto.form");
      $formHandler = $this->get("agp.produto.form.handler");
      if ($formHandler->process($produto)){
          return new JsonResponse(array("status" => "sucesso"));
      }
        
      return array('form' => $form->createView(),
                   'entity' => $produto);  
    }
    
    /**
     * @Route("/edit-group", name="produtoGroupEdit", options={"expose" = true})
     * @Template("")
     */
    public function editGroupAction(Request $request){
        
        $produtos = $request->get("produtos");
        $produtoDummy = new ProdutoDummy;
        foreach ($produtos as $produtoId)
        {
            $produto = $this->get("agp.produto.manager")->findById($produtoId);
            if (!$produto)
                throw $this->createNotFoundException("A produto com id ".$id." não foi encontrado.");
            $produtoDummy->getProdutos()->add($produto);
            
        }
        
        
        $form = $this->createForm(new ProdutoDummyType, $produtoDummy);
       
        return array(
            "produtos" => $produtos,
            'form'    => $form->createView()
        );
        
    }
    
    /**
     * @Route("/update-group", name="produtoGroupUpdate", options={"expose" = true})
     * @Template("AgpAdminBundle:Produto:editGroup.html.twig")
     * @Method({"post"})
     */
    public function updateGroupAction(Request $request){
       
        $produtoDummy = new ProdutoDummy;
        $form = $this->createForm(new ProdutoDummyType, $produtoDummy);
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
           
            if ($form->isValid()) {
                $manager = $this->get("agp.produto.manager");
                
                foreach ($produtoDummy->getProdutos() as $produto) {
                    $manager->saveProduto($produto);
                }
                
                $this->setFlash("sucess", "Produto(s) Alterados(s)");
                return $this->redirect($this->generateUrl("produtoIndex"));
            }
        }
        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/{id}/delete", name="produtoDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function deleteAction($id)
    {
      $produto = $this->get("agp.produto.manager")->findById($id);
      
      if (!$produto){
          throw $this->createNotFoundException("A produto com id ".$id." não foi encontrado.");
      }
      
      $this->get("agp.produto.manager")->deleteProduto($produto);
       return new JsonResponse(array("status" => "sucesso"));;
        
    }
    
    /**
     * @Route("/delete-group", name="produtoGroupDelete", options={"expose" = true})
     * @Template("")
     * @Method({"post"})
     */
    public function groupDeleteAction()
    {
        $produtos = $this->get("request")->request->get("produtos");
        foreach ($produtos as $produtoId)
        {
            $produto = $this->get("agp.produto.manager")->findById($produtoId);;
            if (!$produto)
                throw $this->createNotFoundException("A produto com id ".$id." não foi encontrado.");
            $this->get("agp.produto.manager")->deleteProduto($produto);
        }
        return new JsonResponse(array("status" => "sucesso"));;
    }
    
    /**
     * @Route("/produto-ajax", name="produtoAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function produtoAjaxAction()
    {
        //var_dump($this->get("request")->request->get("sSearch"));die();
        $entities["aaData"] = $this->getDoctrine()->getEntityManager()->createQuery("SELECT p FROM AgpAdminBundle:Produto p WHERE p.empresa = :empresa")->setParameters(array("empresa" => $this->getUser()->getEmpresa()))->getArrayResult();
        return new JsonResponse($entities);
    }
    
    /**
     * @Route("/show/{id}", name="produtoShow", options={"expose" = true})
     * @Template("")
     */
    public function showAction($id)
    {
        $produto = $this->get("agp.produto.manager")->findById($id);     
        if (!$produto)
                throw $this->createNotFoundException("A produto com id ".$id." não foi encontrado.");
        
        if (!$this->isValidAccess($produto)){
            throw new AccessDeniedException;
        }
        
        return (array("entity" => $produto));
    }
    
    public function setFlash($tipo, $msg){
        $session = $this->get("session");
        $session->setFlash($tipo, $msg);
    }
    
    
}

?>
