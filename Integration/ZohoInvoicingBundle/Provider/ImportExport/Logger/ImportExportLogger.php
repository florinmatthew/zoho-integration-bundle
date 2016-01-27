<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Provider\ImportExport\Logger;

use Psr\Log\LogLevel;

use Oro\Bundle\ImportExportBundle\Context\ContextAwareInterface;
use Oro\Bundle\ImportExportBundle\Context\ContextInterface;
use Integration\ZohoInvoicingBundle\Provider\ImportExport\Logger\AbstractLoggerDecorator;

/**
 * Description of ImportExportLogger
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ImportExportLogger extends AbstractLoggerDecorator implements ContextAwareInterface{
    
    /**
     * @var string
     */
    protected $messagePrefix = '';

    /**
     * @var ContextInterface
     */
    protected $context;
    
    protected $dataConverter;

    /**
     * {@inheritdoc}
     */
    protected function getMessage($level, $message, array $context) {
        return $this->messagePrefix . $message;
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array()) {
        if ($this->context
            && in_array($level, [LogLevel::EMERGENCY, LogLevel::ALERT, LogLevel::CRITICAL, LogLevel::ERROR])
        ) {
            $this->context->addError($message);
        }
        return parent::log($level, $message, $context);
    }

    /**
     * @param string $prefix
     */
    public function setMessagePrefix($prefix) {
        $this->messagePrefix = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function setImportExportContext(ContextInterface $context) {
        $this->context = $context;
    }
    
}
