<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Model\EntityProvider;

use Doctrine\Common\Persistence\ManagerRegistry;
/**
 * Description of OroEntityProvider
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class OroEntityProvider {
    
    /**
     * @var ManagerRegistry
     */
    protected $registry;
    
    function __construct(ManagerRegistry $registry) {
        $this->registry = $registry;
    }
    
    /**
     * 
     * @param type $channelId
     * @return type
     */
    public function getChannelById($channelId) {
        return $this->registry->getManager()->find('OroIntegrationBundle:Channel', $channelId);
    }
}
