<?php

namespace Integration\ZohoInvoicingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProductController extends Controller
{
    /**
     * @Route("/product/", name="zoho_product_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
