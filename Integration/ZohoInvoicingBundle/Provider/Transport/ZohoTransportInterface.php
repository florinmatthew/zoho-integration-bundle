<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;
/**
 * Description of ZohoTransportInterface
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
interface ZohoTransportInterface extends TransportInterface{
    
    /**
     * @return \Iterator Description
     */
    public function getProducts();

    /**
     * @return \Iterator Description
     */
    public function getTaxes();
    
    
}
