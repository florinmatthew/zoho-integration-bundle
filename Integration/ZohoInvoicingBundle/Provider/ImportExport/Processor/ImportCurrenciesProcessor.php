<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\ImportExport\Processor;

use Integration\ZohoInvoicingBundle\Provider\ImportExport\AbstractImportProcessor;
use Integration\ZohoInvoicingBundle\Entity\Currencies as CurrenciesEntity;
use Integration\ZohoInvoicingBundle\Model\SyncState;
use Integration\ZohoInvoicingBundle\Model\SyncHelper\CurrenciesSyncHelper;
/**
 * Description of ImportCurrenciesProcessor
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ImportCurrenciesProcessor extends AbstractImportProcessor{
    /**
     * @var SyncState
     */
    protected $syncState;
    
    /**
     * @var type 
     */
    protected $helper;
            
    function __construct(CurrenciesSyncHelper $helper) {
        $this->helper = $helper;
    }

    public function process($entity){
        
        if (!$entity instanceof CurrenciesEntity) {
            throw new InvalidArgumentException(
                sprintf(
                    'Imported entity must be instance of Integration\\ZohoInvoicingBundle\\Entity\\Currencies, %s given.',
                    is_object($entity) ? get_class($entity) : gettype($entity)
                )
            );
        }
        
        $this->helper->refreshChannel($entity, $this->getChannel());        
        $existingCurrencies = $this->helper->findCurrency($entity, $this->getChannel());
        
        if($existingCurrencies){
            $this->helper->copyRemoteData($existingCurrencies, $entity);
            $entity = $existingCurrencies;
            $this->getContext()->incrementUpdateCount();
        }else{
            $this->getContext()->incrementAddCount();
        }
        
        return $entity;
    }
}
