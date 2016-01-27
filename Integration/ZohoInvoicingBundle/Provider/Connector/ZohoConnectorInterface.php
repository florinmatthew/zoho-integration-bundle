<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\Connector;

use Oro\Bundle\IntegrationBundle\Provider\ConnectorInterface as CI;
/**
 * Description of ZohoConnectorInterface
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
interface ZohoConnectorInterface extends CI{
    const PRODUCT_TYPE = "Integration\\ZohoInvoicingBundle\\Entity\\Product";
    const TAX_TYPE = "Integration\\ZohoInvoicingBundle\\Entity\\Tax";
    /*const INVOICE_TYPE = "Integration\\ZohoInvoicingBundle\\Entity\\Invoice";*/
}
