<?php

namespace Integration\ZohoInvoicingBundle\Provider;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChannelType
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ChannelType implements ChannelInterface, IconAwareIntegrationInterface{
    
    const TYPE = "zoho";
    
    public function getLabel() {
        return 'zoho';
    }
    
    public function getIcon() {
        return 'bundles/integrationzohoinvoicing/img/zoho-icon-32-88.png';
    }
    
}
