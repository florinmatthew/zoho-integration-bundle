<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\Transport;

use Symfony\Component\Serializer\SerializerInterface;
use Integration\ZohoInvoicingBundle\Provider\Transport\ZohoTransportInterface;
use Integration\ZohoInvoicingBundle\Entity\Interfaces\ZohoTransportEntityInterface;
use \Oro\Bundle\IntegrationBundle\Provider\Rest\Transport\AbstractRestTransport;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Integration\ZohoInvoicingBundle\Provider\Iterator\ProductIterator;
use Integration\ZohoInvoicingBundle\Provider\Iterator\TaxIterator;
use Integration\ZohoInvoicingBundle\Provider\Iterator\CurrenciesIterator;
use Symfony\Component\HttpFoundation\ParameterBag;
use Oro\Bundle\IntegrationBundle\Provider\Rest\Client\Guzzle\GuzzleRestClient as GRClient;
/**
 * Description of RESTransport
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class RESTransport extends AbstractRestTransport implements ZohoTransportInterface{
    
    protected $serializer;
    
    public function __construct(SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }

    public function init(Transport $transportEntity) {
        $this->settings = $transportEntity->getSettingsBag();
        $this->client = new GRClient($this->settings->get('api_url'));
    }

    public function getLabel(){
        return 'Zoho REST Transport';
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsFormType() {
        return 'zoho_integration_rest_transport_setting_form_type';
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsEntityFQCN() {
        return 'Integration\\ZohoInvoicingBundle\\Entity\\ZohoRestTransport';
    }
    
    /**
     * {@inheritdoc}
     */
    protected function getClientBaseUrl(ParameterBag $parameterBag) {
        return ($parameterBag->get('api_url'));
    }
    
    /**
     * {@inheritdoc}
     */
    protected function getClientOptions(ParameterBag $parameterBag) {
        $token = $parameterBag->get('auth_token');
        return array(
            'auth' => array("authtoken", $token)
        );
    }
    
    /*-------- Import data methods --------*/
    
    /**
     * @return \Iterator Description
     */
    public function getProducts(){
        
        $resource = 'items';
        $params = ['authtoken' => $this->settings->get('auth_token'), 'organization_id' => $this->settings->get('organization_id')];
        
        $result = new ProductIterator($this->getClient(), $resource, $params);
        $result->setupDeserialization($this->serializer, 'Integration\\ZohoInvoicingBundle\\Entity\\Product');
        
        return $result;
    }
    
    public function getTaxes(){
        
        $resource = 'settings/taxes';
        $params = ['authtoken' => $this->settings->get('auth_token'), 'organization_id' => $this->settings->get('organization_id')];
        
        $result = new TaxIterator($this->getClient(), $resource, $params);
        $result->setupDeserialization($this->serializer, 'Integration\\ZohoInvoicingBundle\\Entity\\Tax');
        
        return $result;
    }
    
    public function getCurrencies(){
        
        $resource = '/settings/currencies';
        $params = ['authtoken' => $this->settings->get('auth_token'), 'organization_id' => $this->settings->get('organization_id')];
        
        $result = new CurrenciesIterator($this->getClient(), $resource, $params);
        $result->setupDeserialization($this->serializer, 'Integration\\ZohoInvoicingBundle\\Entity\\Currencies');
        
        return $result;
    }
    
}
