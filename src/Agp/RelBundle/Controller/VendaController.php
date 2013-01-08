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
use Agp\AdminBundle\Form\FormFilter\FilterVendasGeralType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of VendaController
 *
 * @author bondcs
 * @Route("/usuario/relatorio")
 */
class VendaController extends Controller {
    
    /**
     * @Route("/venda", name="vendaGeralRelatorio", options={"expose" = true})
     * @Template()
     */
    public function indexAction()
    {
        $formFilter = $this->createForm(new FilterVendasGeralType($this->getDoctrine()->getRepository("AgpAdminBundle:VendaGeral"), $this->getUser()));
        return array("formFilter" => $formFilter->createView());
    }
    
    /**
     * @Route("/venda-geral-ajax/{terminal}/{grupo}/{fechamento}", name="vendaGeralAjaxRelatorio", options={"expose" = true})
     * @Template()
     * @Method({"post"})
     */
    public function vendageralAjaxAction($terminal, $grupo, $fechamento)
    {
        $rep = $this->getDoctrine()->getRepository("AgpAdminBundle:VendaGeral");
        $user = $this->getUser();
        switch ($grupo){
            case "n":
                $entities = $rep->getVendas($user,$terminal,$fechamento);
                break;
            case "t":
                $entities = $rep->getVendasByTerminal($user,$terminal,$fechamento);
                break;
            case "p":
                $entities = $rep->getVendasByProduto($user,$terminal,$fechamento);
                break;           
        }
        
        return new JsonResponse($entities);
    }
}

?>
