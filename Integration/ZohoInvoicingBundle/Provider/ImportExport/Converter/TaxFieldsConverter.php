<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\ImportExport\Converter;

use Oro\Bundle\IntegrationBundle\ImportExport\DataConverter\IntegrationAwareDataConverter;

/**
 * Description of TaxFieldsConverter
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class TaxFieldsConverter extends IntegrationAwareDataConverter{
    
    protected function getHeaderConversionRules() {
        return [
//            'tax_id'       => 'taxId',
            'tax_name'      => 'taxName',
            'tax_percentage'=> 'taxPercentage',
            'tax_type'=> 'taxType',
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
