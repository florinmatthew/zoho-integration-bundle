<?php

namespace Integration\ZohoInvoicingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class InvoiceController extends Controller
{
    /**
     * @Route("/invoice/", name="zoho_invoice_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
