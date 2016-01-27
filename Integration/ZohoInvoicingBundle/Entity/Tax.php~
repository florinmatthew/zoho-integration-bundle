<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Oro\Bundle\IntegrationBundle\Model\IntegrationEntityTrait;
use Integration\ZohoInvoicingBundle\Entity\Interfaces\ZohoEntityType;
/**
 *
 * @ORM\Entity(repositoryClass="Integration\ZohoInvoicingBundle\Entity\TaxRepository")
 * @ORM\Table(name="zoho_tax",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="zh_tax_id_tax_zhid_cid_unq", columns={"tax_id", "channel_id"})
 *    } 
 * )
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-shopping-cart"
 *          },
 *          "ownership"={
 *              "owner_type"="USER",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "group_name"=""
 *          }
 *      }
 * )
 */
class Tax implements ZohoEntityType{
    use IntegrationEntityTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tax_id", type="string", length=255)
     */
    protected $taxId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tax_name", type="string", length=255)
     */
    protected $taxName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tax_percentage", type="string", length=255)
     */
    protected $taxPercentage;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tax_type", type="string", length=255)
     */
    protected $taxType;
    
    /**
     * Set taxId
     *
     * @param string $taxId
     * @return Tax
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;

        return $this;
    }

    /**
     * Get taxId
     *
     * @return string 
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * Set taxName
     *
     * @param string $taxName
     * @return Tax
     */
    public function setTaxName($taxName)
    {
        $this->taxName = $taxName;

        return $this;
    }

    /**
     * Get taxName
     *
     * @return string 
     */
    public function getTaxName()
    {
        return $this->taxName;
    }

    /**
     * Set taxPercentage
     *
     * @param string $taxPercentage
     * @return Tax
     */
    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;

        return $this;
    }

    /**
     * Get taxPercentage
     *
     * @return string 
     */
    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set taxType
     *
     * @param string $taxType
     * @return Tax
     */
    public function setTaxType($taxType)
    {
        $this->taxType = $taxType;

        return $this;
    }

    /**
     * Get taxType
     *
     * @return string 
     */
    public function getTaxType()
    {
        return $this->taxType;
    }
}
