<?php

namespace Integration\ZohoInvoicingBundle\Command;

use Oro\Bundle\CronBundle\Command\CronCommandInterface;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SyncJobAlter
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class SyncJobAlter implements CronCommandInterface{
    
    /**
     * {@inheritdoc }
     */
    public function getDefaultDefinition(){
        return '5 0 * * *';
    }
    
    protected function configure() {
        $this->setName('oro:cron:demo2');
    }
    
}
