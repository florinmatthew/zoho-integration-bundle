<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Entity;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
/**
 * Description of OriginTrait
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
trait OriginTrait
{
    /**
     * Entity origin id
     * @var integer
     *
     * @ORM\Column(name="origin_id", type="integer", options={"unsigned"=true}, nullable=true)
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "identity"=true
     *          }
     *      }
     * )
     */
    protected $originId;

    /**
     * @param int $originId
     *
     * @return $this
     */
    public function setOriginId($originId)
    {
        $this->originId = $originId;

        return $this;
    }

    /**
     * @return int
     */
    public function getOriginId()
    {
        return $this->originId;
    }
}
