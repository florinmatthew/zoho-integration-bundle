<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\Iterator;
/**
 * Description of ProductIterator
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class CurrenciesIterator extends AbstractZohoRESTiterator{
    
    /**
     * 
     * @param array $data
     * @return array
     */
    protected function getRowsFromPageData(array $data) {
        if(isset($data['message']) && $data['message'] == "success"){
            return $data['currencies'];
        }else{
            return null;
        }
    }
}

