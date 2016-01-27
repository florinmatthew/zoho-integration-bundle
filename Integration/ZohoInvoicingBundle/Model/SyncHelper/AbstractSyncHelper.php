<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Model\SyncHelper;

use Integration\ZohoInvoicingBundle\Model\EntityProvider\ZohoEntityProvider;
use Integration\ZohoInvoicingBundle\Model\EntityProvider\OroEntityProvider;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Symfony\Component\Security\Core\Util\ClassUtils;
use Integration\ZohoInvoicingBundle\Model\SyncHelper\ChangeSetValues\ChangeSet;
use Integration\ZohoInvoicingBundle\Entity\Interfaces\ZohoEntityType;
/**
 * Description of AbstractSyncHelper
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
abstract class AbstractSyncHelper {
    
    /**
     * @var Channel
     */
    protected $channel;
    
    /**
     * @var ZohoEntityProvider
     */
    protected $zohoProvider;
    
    /**
     * @var OroEntityProvider
     */
    protected $oroProvider;
    
    public function __construct(ZohoEntityProvider $zohoProvider, OroEntityProvider $oroProvider) {
        $this->zohoProvider = $zohoProvider;
        $this->oroProvider = $oroProvider;
    }
    
    /**
     * @param Channel $channel
     * @param mixed $entity
     */
    public function refreshChannel(ZohoEntityType $entity, Channel $channel) {
        if ($channel->getId()) {
            $channel = $this->oroProvider->getChannelById($channel->getId());
            $entity->setChannel($channel);
        }
    }
    
    /**
     * 
     * @param type $target
     * @param type $source
     * @param array $excludeProperties
     * @return type
     */
    protected function syncProperties($target, $source, array $excludeProperties = array()) {
        $changeSet = $this->getChangeSet($target, $source, $excludeProperties);
        $changeSet->apply();
        return $changeSet;
    }
    
    /**
     * 
     * @param type $target
     * @param type $source
     * @param array $excludeProperties
     */
    protected function getChangeSet($target, $source, array $excludeProperties = array()){
        if (!is_object($target)) {
            throw new InvalidArgumentException(
                'Expect argument $target has object type object but %s given.',
                gettype($target)
            );
        }
        if (!is_object($source)) {
            throw new InvalidArgumentException(
                'Expect argument $target has object type object but %s given.',
                gettype($source)
            );
        }
        
        $targetClass = ClassUtils::getRealClass($target);
        $sourceClass = ClassUtils::getRealClass($source);
        
        if ($targetClass !== $sourceClass) {
            throw new InvalidArgumentException(
                sprintf(
                    'Expect argument $sourceClass is instance of %s but %s given.',
                    $targetClass,
                    $sourceClass
                )
            );
        }
        
        $reflectionClass = new \ReflectionClass($targetClass);
        $changeSet = new ChangeSet($target, $source);
        
        foreach ($reflectionClass->getProperties() as $property) {
            $propertyName = $property->getName();
            if (in_array($propertyName, $excludeProperties)) {
                continue;
            }
            $changeSet->add($propertyName, $propertyName);
        }
        
        return $changeSet;
    }
    
}
