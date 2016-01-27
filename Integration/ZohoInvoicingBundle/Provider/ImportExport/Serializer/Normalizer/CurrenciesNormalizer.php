<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\ImportExport\Serializer\Normalizer;
/**
 * Description of CurrenciesNormalizer
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class CurrenciesNormalizer extends AbstractNormalizer{
    
    public function getFieldRules() {
        return [
            
            'currencyId' => [
                'normalizeName' => 'currency_id'
            ],
            'currencyCode' => [
                'normalizeName' => 'currency_code'
            ],
            'currencyName' => [
                'normalizeName'  => 'currency_name'
            ],
            'currencySymbol' => [
                'normalizeName'  => 'currency_symbol'
            ],
            'pricePrecision' => [
                'normalizeName' => 'price_precision'
            ],
            'currencyFormat' => [
                'normalizeName' => 'currency_format'
            ],
            'isBaseCurrency' => [
                'normalizeName' => 'is_base_currency'
            ],
            'exchangeRate' => [
                'normalizeName' => 'exchange_rate'
            ],
            'effectiveDate' => [
                'normalizeName' => 'effective_date'
            ]
        ];
    }
    
    public function getTargetClassName() {
        return 'Integration\\ZohoInvoicingBundle\\Entity\\Currencies';
    }
    
}
