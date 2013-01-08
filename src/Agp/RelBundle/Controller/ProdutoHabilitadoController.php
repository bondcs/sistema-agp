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
use Agp\AdminBundle\Form\FormFilter\FilterHabilitaProdutoType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of ProdutoHabilitadoController
 *
 * @author bondcs
 * @Route("/usuario/relatorio")
 */
class ProdutoHabilitadoController extends Controller {
    
    /**
     * @Route("/produto-habilitado", name="produtolHabilitadoRelatorio", options={"expose" = true})
     * @Template()
     */
    public function indexAction()
    {
        $formFilter = $this->createForm(new FilterHabilitaProdutoType($this->getUser()));
        return array("formFilter" => $formFilter->createView());
    }
    
    /**
     * @Route("/produto-habilitado/{terminal}/{lista}", name="produtoHabilitadoRelatiorioAjax", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function produtoHabilitadoAjaxAction($terminal, $lista)
    {
        $rep = $this->getDoctrine()->getRepository("AgpAdminBundle:HabilitaProdutoTerminal");
        $user = $this->getUser();
        $entities = $rep->getProdutosHabilitados($terminal, $lista, $user);
        return new JsonResponse($entities);
    }
}

?>
