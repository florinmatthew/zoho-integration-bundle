<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\ImportExport;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

use Akeneo\Bundle\BatchBundle\Entity\StepExecution;
use Akeneo\Bundle\BatchBundle\Step\StepExecutionAwareInterface;

use Oro\Bundle\ImportExportBundle\Context\ContextRegistry;
use Oro\Bundle\ImportExportBundle\Processor\ContextAwareProcessor;
use Integration\ZohoInvoicingBundle\Provider\ImportExport\Logger\ImportExportLogger;
use Oro\Bundle\ImportExportBundle\Context\ContextInterface;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Oro\Bundle\IntegrationBundle\Provider\ConnectorContextMediator;

use Oro\Bundle\ImportExportBundle\Processor\ImportProcessor;
/**
 * Description of AbstractImportProcessor
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
abstract class AbstractImportProcessor extends ImportProcessor implements 
        StepExecutionAwareInterface, 
        ContextAwareProcessor, 
        LoggerAwareInterface{
    //put your code here
   
    /**
     * @var ConnectorContextMediator
     */
    private $connectorContextMediator;
//    
//    /**
//     * @var ContextInterface
//     */
//    protected $context;
    
    /**
     * @var ContextRegistry
     */
    private $contextRegistry;
    
    /**
     * @var ImportExportLogger
     */
    private $logger;
    
    /**
     * @var Channel
     */
    private $channel = null;
    
    /**
     * @return Channel
     */
    protected function getChannel() {
        if ($this->channel === null || $this->context->getOption('channel') !== $this->channel->getId()) {
            $this->channel = $this->connectorContextMediator->getChannel($this->context);
        }
        return $this->channel;
    }
    
    /**
     * @param ContextRegistry $contextRegistry
     */
    public function setContextRegistry(ContextRegistry $contextRegistry) {
        $this->contextRegistry = $contextRegistry;
    }
    
    public function setStepExecution(StepExecution $stepExecution) {
        $this->setImportExportContext($this->contextRegistry->getByStepExecution($stepExecution));
    }
    
    public function setLogger(LoggerInterface $logger) {
        $this->logger = new ImportExportLogger($logger);
    }
    
    protected function getLogger() {
        if (!$this->logger) {
            $this->logger = new ImportExportLogger(new NullLogger());
        }
        $this->logger->setImportExportContext($this->getContext());
        return $this->logger;
    }
    
    /**
     * @param ConnectorContextMediator $connectorContextMediator
     */
    public function setConnectorContextMediator(ConnectorContextMediator $connectorContextMediator) {
        $this->connectorContextMediator = $connectorContextMediator;
    }
    
    /**
     * @param ContextInterface $context
     */
    public function setImportExportContext(ContextInterface $context) {
        $this->context = $context;
    }
    
    protected function getContext() {
        return $this->context;
    }
    
}
