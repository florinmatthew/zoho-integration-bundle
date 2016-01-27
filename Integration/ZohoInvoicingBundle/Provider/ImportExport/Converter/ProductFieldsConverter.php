<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\ImportExport\Converter;

use Oro\Bundle\IntegrationBundle\ImportExport\DataConverter\IntegrationAwareDataConverter;
/**
 * Description of ProductFieldsConverter
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ProductFieldsConverter extends IntegrationAwareDataConverter{
    
    protected function getHeaderConversionRules() {
        return [
            'item_id'       => 'itemId',
            'item_name'     => 'itemName',
            'is_linked_with_zohocrm'    => 'isLikedWithZohocrm',
            'zcrm_product_id'           => 'zcrmProductId',
//            'tax_id'        => 'taxOriginId'
        ];
    }

    /**
     * Get maximum backend header for current entity
     *
     * @return array
     */
    protected function getBackendHeader(){
        return array_values($this->getHeaderConversionRules());
    }
    
}
