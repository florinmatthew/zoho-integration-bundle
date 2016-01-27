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
class TaxNormalizer extends AbstractNormalizer{
    
    public function getFieldRules() {
        return [
            'taxId' => [
                'normalizeName' => 'tax_id'
            ],
            'taxName' => [
                'normalizeName' => 'tax_name'
            ],
            'taxPercentage' => [
                'normalizeName' => 'tax_percentage'
            ],
            'taxType' => [
                'normalizeName' => 'tax_type'
            ]
        ];
    }
    
    public function getTargetClassName() {
        return 'Integration\\ZohoInvoicingBundle\\Entity\\Tax';
    }
    
}
