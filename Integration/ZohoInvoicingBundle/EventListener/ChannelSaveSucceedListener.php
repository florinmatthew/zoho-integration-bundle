<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\EventListener;
use OroCRM\Bundle\ChannelBundle\EventListener\ChannelSaveSucceedListener as BaseChannelSaveSucceedListener;
use Integration\ZohoInvoicingBundle\Entity\ZohoRestTransport;
use Oro\Bundle\IntegrationBundle\Manager\TypesRegistry;
use OroCRM\Bundle\MagentoBundle\Provider\ChannelType;
use OroCRM\Bundle\ChannelBundle\Event\ChannelSaveEvent;
/**
 * Description of ChannelSaveSucceedListener
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ChannelSaveSucceedListener extends BaseChannelSaveSucceedListener{
    /**
     * @var TypesRegistry
     */
    protected $typeRegistry;

    /**
     * @var MagentoSoapTransport
     */
    protected $transportEntity;

    /**
     * @param TypesRegistry $registry
     */
    public function setConnectorsTypeRegistry(TypesRegistry $registry){
        $this->typeRegistry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function onChannelSucceedSave(ChannelSaveEvent $event){
        $channel = $event->getChannel();

        if ($channel->getChannelType() === ChannelType::TYPE
            && $channel->getDataSource()->getTransport() instanceof ZohoRestTransport
        ) {
            $this->transportEntity = $channel->getDataSource()->getTransport();

            parent::onChannelSucceedSave($event);
        }
    }
    
    
    
}
