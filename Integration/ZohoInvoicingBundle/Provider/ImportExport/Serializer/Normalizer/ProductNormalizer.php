<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\ImportExport\Serializer\Normalizer;

/**
 * Description of ProductNormalizer
 *
 * @author florin
 */
class ProductNormalizer extends AbstractNormalizer{
    
    public function getFieldRules() {
        return [
            'name',
            'itemId' => [
                'normalizeName' => 'item_id'
            ],
            'itemName' => [
                'normalizeName' => 'item_name'
            ],
            
            'status',
            'source',
            'isLikedWithZohocrm' => [
                'normalizeName'  => 'is_linked_with_zohocrm'
            ],
            'zcrmProductId' => [
                'normalizeName'  => 'zohocrm_product_id'
            ],
            'description',
            'rate',
            'taxOriginId' => [
                'normalizeName' => 'tax_id'
            ],
        ];
    }
    
    public function getTargetClassName() {
        return 'Integration\\ZohoInvoicingBundle\\Entity\\Product';
    }
    
}
