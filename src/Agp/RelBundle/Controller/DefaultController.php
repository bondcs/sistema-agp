<?php

namespace Agp\RelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/usuario/relatorio")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="relatorioIndex")
     * @Template()
     */
    public function indexAction()
    {
        return $this->forward("AgpRelBundle:Venda:index");
    }
}
