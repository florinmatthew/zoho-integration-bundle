<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Model\SyncHelper;

use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Integration\ZohoInvoicingBundle\Entity\Product;
use Integration\ZohoInvoicingBundle\Model\SyncHelper\AbstractSyncHelper;
/**
 * Description of ProductSyncHelper
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ProductSyncHelper extends AbstractSyncHelper{
    
    /**
     * 
     * @param Product $product
     * @param Channel $channel
     * @return type
     */
    public function findProduct(Product $product, Channel $channel){
        return $this->zohoProvider->getProduct($product, $channel);
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
    
    /**
     * 
     * @param Product $product
     */
    public function syncWithTaxEntity(Product $product){
//  
        $tax = $this->zohoProvider->findTaxByTaxId($product->getTaxOriginId());
        
        if($tax){
            $product->setTax($tax);
        }
        
        return $product;
    }
    
}
