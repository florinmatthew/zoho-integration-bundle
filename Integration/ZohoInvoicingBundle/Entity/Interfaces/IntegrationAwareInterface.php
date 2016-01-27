<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Entity\Interfaces;

use Oro\Bundle\IntegrationBundle\Entity\Channel as Integration;
/**
 * Description of IntegrationAwareInterface
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
interface IntegrationAwareInterface {
    /**
     * @param Integration $integration
     * @return IntegrationAwareInterface
     */
    public function setChannel(Integration $integration);

    /**
     * @return Integration
     */
    public function getChannel();

    /**
     * @return string
     */
    public function getChannelName();
}
