<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Model;

/**
 * Description of SyncManager
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class SyncManager {
    
    /**
     * @var SyncScheduler
     */
    protected $syncScheduler;
    
    /**
     * @var ManagerRegistry
     */
    protected $registry;
    
    /**
     * @var ZendeskEntityProvider
     */
    protected $zendeskEntityProvider;
    
}
