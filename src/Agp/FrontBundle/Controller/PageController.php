<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Agp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of PageController
 *
 * @author bondcs
 */
class PageController extends Controller {
    
    /**
     * @Route("/", name="pageIndex")
     * @Template()
     *
     */
    public function indexAction()
    {
        return (array("user" => $this->getUser()));
    }
}

?>
