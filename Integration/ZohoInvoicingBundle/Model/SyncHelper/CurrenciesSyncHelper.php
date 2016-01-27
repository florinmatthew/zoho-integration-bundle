<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Model\SyncHelper;
use Integration\ZohoInvoicingBundle\Entity\Currencies;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
/**
 * Description of CurrenciesSyncHelper
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class CurrenciesSyncHelper extends AbstractSyncHelper{
    
    public function findCurrency(Currencies $currency, Channel $channel){
        return $this->zohoProvider->getCurrency($currency, $channel);
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
