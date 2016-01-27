<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Description of TaxController
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class TaxController extends Controller{
    /**
     * @Route("/tax/", name="zoho_tax_index")
     * @Template()
     */
    public function indexAction() {
        return array();
    }
}
