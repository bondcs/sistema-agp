<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\RelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Agp\AdminBundle\Form\FormFilter\FilterAquisicaoType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of AquisicaoController
 *
 * @author bondcs
 * @Route("/usuario/relatorio")
 */
class AquisicaoController extends Controller {
    
    /**
     * @Route("/aquisicao", name="aquisicaoRelatorio", options={"expose" = true})
     * @Template()
     */
    public function indexAction()
    {
        $formFilter = $this->createForm(new FilterAquisicaoType($this->getUser()));
        return array("formFilter" => $formFilter->createView());
    }
    
    /**
     * @Route("/aquisicao/", name="aquisicaoRelatiorioAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function aquisicaoAjaxAction(Request $request)
    {
        $produto = $request->get('produto');
        $fornecedor = $request->get('fornecedor');
        $dtInicio = $request->get('dtInicio');
        $dtTermino = $request->get('dtTermino');
        $user = $this->getUser();
        
        $rep = $this->getDoctrine()->getRepository("AgpAdminBundle:EntradaProduto");
        
        $entities = $rep->getProdutosHabilitados($produto, $fornecedor, $dtInicio, $dtTermino, $user);
        return new JsonResponse($entities);
    }
}

?>
