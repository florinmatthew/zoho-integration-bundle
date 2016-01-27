<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Model\EntityProvider;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

use Integration\ZohoInvoicingBundle\Entity\Product;
use Integration\ZohoInvoicingBundle\Entity\Currencies;
use Integration\ZohoInvoicingBundle\Entity\Tax;
use Oro\Bundle\IntegrationBundle\Entity\Channel;

/**
 * Description of ZohoEntityProvider
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ZohoEntityProvider {
    
    /** @var ManagerRegistry */
    protected $registry;
    
    function __construct(ManagerRegistry $registry) {
        $this->registry = $registry;
    }
    
    /**
     * 
     * @param Product $product
     * @param Channel $channel
     * @return type
     */
    public function getProduct(Product $product, Channel $channel){
        
        $criteria = ['itemId' => $product->getItemId(), 'channel' => $channel];
        $result = $this->registry->getRepository('IntegrationZohoInvoicingBundle:Product')
                ->findOneBy($criteria);
        
        return $result;
    }
    
    /**
     * 
     */
    public function getTax(Tax $tax, Channel $channel){
        
        $criteria = ['taxId' => $tax->getTaxId(), 'channel' => $channel];
        $result = $this->registry->getRepository('IntegrationZohoInvoicingBundle:Tax')
                ->findOneBy($criteria);
        
        return $result;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function findTaxByTaxId($id){
        
        $criteria = ['taxId' => $id];
        return $this->registry->getRepository('IntegrationZohoInvoicingBundle:Tax')->findOneBy($criteria);
    }
    
    /**
     * 
     */
    public function getCurrency(Currencies $currency, Channel $channel){
        
        $criteria = ['currencyId' => $currency->getCurrencyId(), 'channel' => $channel];
        $result = $this->registry->getRepository('IntegrationZohoInvoicingBundle:Currencies')
                ->findOneBy($criteria);
        
        return $result;
    }
    
}
