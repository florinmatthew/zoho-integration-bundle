<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\ImportExport\Processor;

use Oro\Bundle\ImportExportBundle\Exception\InvalidArgumentException;

use Integration\ZohoInvoicingBundle\Provider\ImportExport\AbstractImportProcessor;
use Integration\ZohoInvoicingBundle\Entity\Product as ProductEntity;
use Integration\ZohoInvoicingBundle\Model\SyncState;
use Integration\ZohoInvoicingBundle\Model\SyncHelper\ProductSyncHelper;
/**
 * Description of ImportProductProcessor
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ImportProductProcessor extends AbstractImportProcessor{
    
    /**
     * @var SyncState
     */
    protected $syncState;
    
    /**
     * @var type 
     */
    protected $helper;
            
    function __construct(ProductSyncHelper $helper) {
        $this->helper = $helper;
    }

    public function process($entity){
        
        if (!$entity instanceof ProductEntity) {
            throw new InvalidArgumentException(
                sprintf(
                    'Imported entity must be instance of Integration\\ZohoInvoicingBundle\\Entity\\Product, %s given.',
                    is_object($entity) ? get_class($entity) : gettype($entity)
                )
            );
        }
        
        $this->helper->refreshChannel($entity, $this->getChannel());
        $existingProduct = $this->helper->findProduct($entity, $this->getChannel());
        
        if($existingProduct){
            $this->helper->copyRemoteData($existingProduct, $entity);
            $entity = $existingProduct;
            $this->getContext()->incrementUpdateCount();
        }else{
            $this->getContext()->incrementAddCount();
        }
        
//        $entity->setTaxProductId('1212');
        
        //Sync tax entity
        $entity = $this->helper->syncWithTaxEntity($entity);
        
        return $entity;
    }
    
}
