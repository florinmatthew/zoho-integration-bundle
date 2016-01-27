<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Entity\Interfaces;
/**
 * Description of IOriginAware
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */

interface OriginAwareInterface {
    /**
     * @param int $originId
     *
     * @return OriginAwareInterface
     */
    public function setOriginId($originId);

    /**
     * @return int
     */
    public function getOriginId();
}