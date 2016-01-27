<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Model\SyncHelper;

use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Integration\ZohoInvoicingBundle\Entity\Tax;
use Integration\ZohoInvoicingBundle\Model\SyncHelper\AbstractSyncHelper;

/**
 * Description of TaxSyncHelper
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class TaxSyncHelper extends AbstractSyncHelper{
    
    /**
     * 
     * @param Tax $tax
     * @param Channel $channel
     * @return type
     */
    public function findTax(Tax $tax, Channel $channel){
        return $this->zohoProvider->getTax($tax, $channel);
    }
    
    /**
     * 
     * @param type $localEntity
     * @param type $remoteEntity
     */
    public function copyRemoteData($localEntity, $remoteEntity){
        $this->syncProperties($localEntity, $remoteEntity, [
            'id'
        ]);
    }
    
}
