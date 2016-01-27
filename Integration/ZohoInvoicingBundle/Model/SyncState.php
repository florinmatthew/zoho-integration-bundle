<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Model;

use Doctrine\Common\Persistence\ManagerRegistry;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Oro\Bundle\IntegrationBundle\Entity\Status;

/**
 * Description of SyncState
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class SyncState {
    
    /**
     * @var ManagerRegistry
     */
    protected $managerRegistry;
    
    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry) {
        $this->managerRegistry = $managerRegistry;
    }
    
    /**
     * @param Channel $channel
     * @param string  $connector
     *
     * @return \DateTime|null
     */
    public function getLastSyncDate(Channel $channel, $connector) {
        $status = $this->managerRegistry->getRepository('OroIntegrationBundle:Channel')
            ->getLastStatusForConnector($channel, $connector, Status::STATUS_COMPLETED);
        return $status ? $status->getDate() : null;
    }
    
    /**
     * @return array
     */
    public function getTicketIds() {
        return $this->ticketIds;
    }
    
    /**
     * @param int $id
     *
     * @return SyncState
     */
    public function addTicketId($id) {
        $this->ticketIds[] = $id;
        return $this;
    }
    
    /**
     * @param array $ticketIds
     *
     * @return SyncState
     */
    public function setTicketIds(array $ticketIds) {
        $this->ticketIds = $ticketIds;
        return $this;
    }
    
}
