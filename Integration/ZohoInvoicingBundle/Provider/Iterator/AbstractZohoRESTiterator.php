<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\Iterator;

use Symfony\Component\Serializer\SerializerInterface;
use Oro\Bundle\IntegrationBundle\Provider\Rest\Client\AbstractRestIterator;
use Oro\Bundle\IntegrationBundle\Provider\Rest\Client\RestClientInterface;
/**
 * Description of RESTiterator
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
abstract class AbstractZohoRESTiterator extends AbstractRestIterator{
    
    /**
     * @var type 
     */
    protected $resource;
    
    /**
     * @var array Params 
     */
    protected $params;
    
    /**
     * @var string
     */
    protected $itemType;
    
    /**
     * @var SerializerInterface
     */
    protected $serializer;
    
    function __construct(RestClientInterface $client, $resource, array $params = []) {
        parent::__construct($client);
        $this->resource = $resource;
        $this->params = $params;
    }
    
    protected function loadPage(RestClientInterface $client){
        $data = null; $result = null;
        
        if(!$this->firstLoaded){
            $data = $client->get($this->resource, $this->params);
        }
        
        if($data){
            $result = json_decode($data->getBodyAsString(), true);
        }
        
        return $result;
        
    }
    
    /**
     * 
     * @param array $data
     * @param type $previousValue
     * @return array
     */
    protected function getTotalCountFromPageData(array $data, $previousValue) {
        if(isset($data['page_context']['per_page'])){
            return $data['page_context']['per_page'];
        }else{
            return $previousValue;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function current() {
        $result = parent::current();
        
        if ($result !== null && $this->serializer) {
            $result = $this->serializer->deserialize($result, $this->itemType, null, $this->deserializeContext);
        }
        
        return $result;
    }
    
    /**
     * @param SerializerInterface $serializer
     * @param string $type
     * @param array $context
     */
    public function setupDeserialization(SerializerInterface $serializer, $type, array $context = []) {
        $this->serializer = $serializer;
        $this->itemType = $type;
        $this->deserializeContext = $context;
    }
    
}
