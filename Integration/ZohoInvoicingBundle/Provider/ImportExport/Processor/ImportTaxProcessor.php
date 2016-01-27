<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\ImportExport\Processor;

use Oro\Bundle\ImportExportBundle\Exception\InvalidArgumentException;
use Integration\ZohoInvoicingBundle\Provider\ImportExport\AbstractImportProcessor;
use Integration\ZohoInvoicingBundle\Entity\Tax as TaxEntity;
use Integration\ZohoInvoicingBundle\Model\SyncState;
use Integration\ZohoInvoicingBundle\Model\SyncHelper\TaxSyncHelper;

/**
 * Description of ImportTaxProcessor
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ImportTaxProcessor extends AbstractImportProcessor{
    
    /**
     * @var SyncState
     */
    protected $syncState;
    
    /**
     * @var type 
     */
    protected $helper;
            
    function __construct(TaxSyncHelper $helper) {
        $this->helper = $helper;
    }

    public function process($entity){
        
        if (!$entity instanceof TaxEntity) {
            throw new InvalidArgumentException(
                sprintf(
                    'Imported entity must be instance of Integration\\ZohoInvoicingBundle\\Entity\\Tax, %s given.',
                    is_object($entity) ? get_class($entity) : gettype($entity)
                )
            );
        }
        
        $this->helper->refreshChannel($entity, $this->getChannel());        
        $existingTax = $this->helper->findTax($entity, $this->getChannel());
        
        if($existingTax){
            $this->helper->copyRemoteData($existingTax, $entity);
            $entity = $existingTax;
            $this->getContext()->incrementUpdateCount();
        }else{
            $this->getContext()->incrementAddCount();
        }
        
        return $entity;
    }
    
}
