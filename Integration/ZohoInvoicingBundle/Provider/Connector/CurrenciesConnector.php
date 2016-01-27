<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\Connector;

/**
 * Description of CurrenciesConnector
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class CurrenciesConnector extends AbstractZohoConnector{
    
    const IMPORT_JOB_NAME = 'zoho_currencies_import';
    const TYPE = 'currencies';
    const IMPORT_ENTITY = 'Integration\ZohoInvoicingBundle\Entity\Currencies';
    
    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'integration.zohoinvoicing.connector.currencies.label';
    }
    
    /**
     * {@inheritdoc}
     */
    public function getImportEntityFQCN()
    {
        return self::IMPORT_ENTITY;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return self::TYPE;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getImportJobName()
    {
        return self::IMPORT_JOB_NAME;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function getConnectorSource()
    {
        return $this->transport->getCurrencies();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsForceSync()
    {
        return true;
    }
}

