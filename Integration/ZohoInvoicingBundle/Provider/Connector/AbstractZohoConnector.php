<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\Connector;

use Oro\Bundle\ImportExportBundle\Context\ContextRegistry;
use Oro\Bundle\ImportExportBundle\Context\ContextInterface;
use Oro\Bundle\IntegrationBundle\Entity\Channel as Integration;
use Oro\Bundle\IntegrationBundle\Entity\Status;
use Oro\Bundle\IntegrationBundle\Exception\RuntimeException;
use Oro\Bundle\IntegrationBundle\Logger\LoggerStrategy;
use Oro\Bundle\IntegrationBundle\Provider\AbstractConnector;
use Oro\Bundle\IntegrationBundle\Provider\ConnectorContextMediator;
use Integration\ZohoInvoicingBundle\Provider\ZohoTransportInterface;
use OroCRM\Bundle\ZendeskBundle\Model\SyncState;

/**
 * Description of AbstractZohoConnector
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
abstract class AbstractZohoConnector extends AbstractConnector {
    
    /**
     *
     * @var SyncState 
     */
//    protected $syncState;
    
    /** 
     * @var ZohoTransportInterface 
     */
    protected $transport;

    /**
     * @param ContextRegistry          $contextRegistry
     * @param LoggerStrategy           $logger
     * @param ConnectorContextMediator $contextMediator
     * @param array                    $bundleConfiguration
     */
    public function __construct(ContextRegistry $contextRegistry, 
            LoggerStrategy $logger, ConnectorContextMediator 
            $contextMediator){
//        $this->syncState = $syncState;
        parent::__construct($contextRegistry, $logger, $contextMediator);
        
    }
    
    
    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function setManagerRegistry(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function getImportEntityFQCN()
    {
        if (!$this->className) {
            throw new \InvalidArgumentException(sprintf('Entity FQCN is missing for "%s" connector', $this->getType()));
        }

        return $this->className;
    }

    /**
     * @param ContextInterface $context
     */
    protected function initializeTransport(ContextInterface $context)
    {
        $this->channel   = $this->contextMediator->getChannel($context);
        $this->transport = $this->contextMediator->getInitializedTransport($this->channel, true);
        
        $this->validateConfiguration();
        $this->setSourceIterator($this->getConnectorSource());

        $sourceIterator = $this->getSourceIterator();
        if ($sourceIterator instanceof LoggerAwareInterface) {
            $sourceIterator->setLogger($this->logger);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function validateConfiguration()
    {
        parent::validateConfiguration();

        if (!$this->transport instanceof \Integration\ZohoInvoicingBundle\Provider\Transport\ZohoTransportInterface) {
            throw new \LogicException('Option "transport" should implement "ZohoTransportInterface"');
        }
    }

}
