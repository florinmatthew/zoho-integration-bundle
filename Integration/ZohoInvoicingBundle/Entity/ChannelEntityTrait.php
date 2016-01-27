<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Entity;

use OroCRM\Bundle\ChannelBundle\Entity\Channel;
/**
 * Description of ChannelEntityTrait
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
trait ChannelEntityTrait {
    /**
     * @var Channel
     *
     * @ORM\ManyToOne(targetEntity="OroCRM\Bundle\ChannelBundle\Entity\Channel")
     * @ORM\JoinColumn(name="data_channel_id", referencedColumnName="id", onDelete="SET NULL")
     * @ConfigField(
     *  defaultValues={
     *      "importexport"={
     *          "excluded"=true
     *      }
     *  }
     * )
     */
    protected $dataChannel;

    /**
     * @param Channel|null $channel
     * @return self
     *
     * @TODO remove null after BAP-5248
     */
    public function setDataChannel(Channel $channel = null) {
        $this->dataChannel = $channel;

        return $this;
    }

    /**
     * @return Channel
     */
    public function getDataChannel() {
        return $this->dataChannel;
    }
}