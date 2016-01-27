<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\Connector;

/**
 * Description of TaxConnector
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */

class TaxConnector extends AbstractZohoConnector{
    
    const IMPORT_JOB_NAME = 'zoho_tax_import';
    const TYPE = 'tax';
    const IMPORT_ENTITY = 'Integration\ZohoInvoicingBundle\Entity\Tax';
    
    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'integration.zohoinvoicing.connector.tax.label';
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
        return $this->transport->getTaxes();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsForceSync()
    {
        return true;
    }
}
